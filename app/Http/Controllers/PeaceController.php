<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peace;
use Illuminate\Support\Str;

class PeaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peace = Peace::all();
        return view('peace.peace', compact('peace'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('peace.create');
    }

    /**
     * Store a newly created resource in storage.a
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidatePeace();

        try {
            $peace = new Peace(request([
                'name',
                'state_id',
                'participant',
            ]));
            $peace->slug = Str::uuid();
            $peace->save();
            return back()->with('success', 'Peace group added successfully');
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
        $peace = Peace::where('slug', $slug)->first();
        return view('peace.edit', compact('peace'));
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
        $this->ValidatePeace();
        try {
            $peace = Peace::find($request->id);
            $peace->update([
                'name'=>$request->name,
                'state_id'=>$request->state_id,
                'participant'=>$request->participant
            ]);
            return redirect(route('peace.index'))->with('success', 'Peace group updated successfully');
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
        $peace = Peace::where('slug', $slug)->first();
        if ($peace) {
            $peace->delete();
            return redirect('/peace/list')->with('success', 'Peace group removed');
        } else {
            return redirect('/peace/list')->with('error', 'Peace group not found');
        }
    }

    /**
     * Get Deleted peace group
     */
    public function getDeletedPeace()
    {
        $peace = Peace::onlyTrashed()->get();
        return view('peace.delete', compact('peace'));
    }

    /**
     * Restore Deleted peace group
     */
    public function restoreDeletedPeace($slug)
    {
        try {
            $peace = Peace::where('slug', $slug)->withTrashed()->first();
            $peace->restore();
            return redirect(route('peace.index'))
                        ->with('success', 'Peace group restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Permanently delete peace group
     */
    public function permanentlyDeletePeace($slug)
    {
        try {
            $peace =Peace::where('slug', $slug)->withTrashed()->first();
            $peace->forceDelete();
            return redirect(route('peace.index'))
                    ->with('success', 'Permanently deleted peace group successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    protected function ValidatePeace()
    {
        return request()->validate(
            [
                'name'=>'required|string',
                'state_id'=>'required',
                'participant'=>'required|integer'
            ]
        );
    }
}
