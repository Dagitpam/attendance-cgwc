<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wash;
use Illuminate\Support\Str;

class WashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wash = Wash::all();
        return view('wash.wash', compact('wash'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('wash.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidateWash();

        try {
            $wash = new Wash(request([
                'number',
                'wash_type',
                'state_id',
            ]));
            $wash->slug = Str::uuid();
            $wash->save();
            return back()->with('success', 'Wash Infrastructure added successfully');
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
        $wash = Wash::where('slug', $slug)->first();
        return view('wash.edit', compact('wash'));
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
        $this->ValidateWash();
        try {
            $wash = Wash::find($request->id);
            $wash->update([
                'number'=>$request->number,
                'wash_type'=>$request->wash_type,
                'state_id'=>$request->state_id,
            ]);
            return redirect(route('wash.index'))->with('success', 'Wash Infrastructure updated successfully');
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
        $wash = Wash::where('slug', $slug)->first();
        if ($wash) {
            $wash->delete();
            return redirect('/wash/list')->with('success', 'Wash Infrastructure removed');
        } else {
            return redirect('/wash/list')->with('error', 'Wash Infrastructure not found');
        }
    }

    /**
     * Get Deleted wash infrastructure
     */
    public function getDeletedWash()
    {
        $wash = Wash::onlyTrashed()->get();
        return view('wash.delete', compact('wash'));
    }

    /**
     * Restore Deleted wash infrastructure
     */
    public function restoreDeletedWash($slug)
    {
        try {
            $wash = Wash::where('slug', $slug)->withTrashed()->first();
            $wash->restore();
            return redirect(route('wash.index'))
                        ->with('success', 'Wash Infrastructure restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Permanently delete wash infrastructure
     */
    public function permanentlyDeleteWash($slug)
    {
        try {
            $wash = Wash::where('slug', $slug)->withTrashed()->first();
            $wash->forceDelete();
            return redirect(route('wash.index'))
                    ->with('success', 'Permanently deleted wash infrastructure successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }



    protected function ValidateWash()
    {
        return request()->validate(
            [
                'number'=>'required|integer',
                'wash_type'=>'required|string',
                'state_id'=>'required',
            ]
        );
    }
}
