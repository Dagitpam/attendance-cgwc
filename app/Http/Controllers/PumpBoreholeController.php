<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Pump_Borehole;

class PumpBoreholeController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $pump = Pump_Borehole::all();
        return view('pump.index', compact('pump'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pump.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidatePump();

        try {
            $pump = new Pump_Borehole(request([
                'location',
                'number',
                'state_id',
                'type'
            ]));
            $pump->slug = Str::uuid();
            $pump->save();
            return back()->with('success', 'New Number of Boreholes added successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $pump = Pump_Borehole::where('slug', $slug)->first();
        return view('pump.edit', compact('pump'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->ValidatePump();
        try {
            $pump = Pump_Borehole::find($request->id);
            $pump->update([
                'location'=>$request->location,
                'number'=>$request->number,
                'state_id'=>$request->state_id,
                'type'=>$request->type
            ]);
            return redirect(route('borehole.index'))->with('success', 'New Number of Boreholes updated successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($slug)
    {
        $pump = Pump_Borehole::where('slug', $slug)->first();
        if ($pump) {
            $pump->delete();
            return redirect('/borehole/list')->with('success', 'Borehole removed');
        } else {
            return redirect('/borehole/list')->with('error', 'Borehole not found');
        }
    }

    /**
     * Get Deleted Pump Borehole
     */
    public function getDeletedBorehole()
    {
        $pump = Pump_Borehole::onlyTrashed()->get();
        return view('pump.delete', compact('pump'));
    }

    /**
     * Restore Deleted borehole
     */
    public function restoreDeletedBorehole($slug)
    {
        try {
            $pump = Pump_Borehole::where('slug', $slug)->withTrashed()->first();
            $pump->restore();
            return redirect(route('borehole.index'))
                        ->with('success', 'Borehole restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Permanently delete borehole
     */
    public function permanentlyDeleteBorehole($slug)
    {
        try {
            $pump = Pump_Borehole::where('slug', $slug)->withTrashed()->first();
            $pump->forceDelete();
            return redirect(route('borehole.index'))
                    ->with('success', 'Permanently deleted  borehole successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }



    protected function ValidatePump()
    {
        return request()->validate(
            [
                'location'=>'required|string',
                'number'=>'required|integer',
                'state_id'=>'required',
                'type'=>'required|string'
            ]
        );
    }
}
