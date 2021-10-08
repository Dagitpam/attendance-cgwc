<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Complain;

class ComplainController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $complain = Complain::all();
        return view('complains.complain', compact('complain'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('complains.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidateComplain();

        try {
            $complain = new Complain(request([
                'number',
                'state_id',
            ]));
            $complain->slug = Str::uuid();
            $complain->save();
            return back()->with('success', 'Total complains by state added successfully');
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
        $complain = Complain::where('slug', $slug)->first();
        return view('complains.edit', compact('complain'));
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
        $this->ValidateComplain();
        try {
            $complain = Complain::find($request->id);
            $complain->update([
                'number'=>$request->number,
                'state_id'=>$request->state_id,
            ]);
            return redirect(route('complain.index'))->with('success', 'Complain updated successfully');
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
        $complain = Complain::where('slug', $slug)->first();
        if ($complain) {
            $complain->delete();
            return redirect('/complain/list')->with('success', 'Complain removed');
        } else {
            return redirect('/complain/list')->with('error', 'Complain not found');
        }
    }

    /**
     * Get Deleted allocatio
     */
    public function getDeletedComplain()
    {
        $complain = Complain::onlyTrashed()->get();
        return view('complains.delete', compact('complain'));
    }

    /**
     * Restore Deleted indicator
     */
    public function restoreDeletedComplain($slug)
    {
        try {
            $complain = Complain::where('slug', $slug)->withTrashed()->first();
            $complain->restore();
            return redirect(route('complain.index'))
                        ->with('success', 'Complain restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Permanently delete indicator
     */
    public function permanentlyDeleteComplain($slug)
    {
        try {
            $complain = Complain::where('slug', $slug)->withTrashed()->first();
            $complain->forceDelete();
            return redirect(route('complain.index'))
                    ->with('success', 'Permanently deleted complain successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }



    protected function ValidateComplain()
    {
        return request()->validate(
            [
                'number'=>'required|integer',
                'state_id'=>'required',
            ]
        );
    }
}
