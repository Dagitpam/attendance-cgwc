<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Allocation;
use Illuminate\Support\Str;

class AllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allocation = Allocation::all();
        return view('allocation.allocation', compact('allocation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('allocation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidateAllocation();

        try {
            $allocation = new Allocation(request([
                'amount',
                'state_id',
                'status',
            ]));
            $allocation->slug = Str::uuid();
            $allocation->save();
            return back()->with('success', 'Amount allocated to state added successfully');
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
        $allocation = Allocation::where('slug', $slug)->first();
        return view('allocation.allocation-edit', compact('allocation'));
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
        $this->ValidateAllocation();
        try {
            $allocation = Allocation::find($request->id);
            $allocation->update([
                'amount'=>$request->amount,
                'state_id'=>$request->state_id,
                'status'=>$request->status
            ]);
            return redirect(route('allocation.index'))->with('success', 'Allocation updated successfully');
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
        $allocation = Allocation::where('slug', $slug)->first();
        if ($allocation) {
            $allocation->delete();
            return redirect('/allocation/list')->with('success', 'Allocation removed');
        } else {
            return redirect('/allocation/list')->with('error', 'Allocation not found');
        }
    }

    /**
     * Get Deleted allocatio
     */
    public function getDeletedAllocation()
    {
        $allocation = Allocation::onlyTrashed()->get();
        return view('allocation.deleted', compact('allocation'));
    }

    /**
     * Restore Deleted indicator
     */
    public function restoreDeletedAllocation($slug)
    {
        try {
            $allocation = Allocation::where('slug', $slug)->withTrashed()->first();
            $allocation->restore();
            return redirect(route('allocation.index'))
                        ->with('success', 'Allocation restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Permanently delete indicator
     */
    public function permanentlyDeleteAllocation($slug)
    {
        try {
            $allocation =Allocation::where('slug', $slug)->withTrashed()->first();
            $allocation->forceDelete();
            return redirect(route('allocation.index'))
                    ->with('success', 'Permanently deleted allocation successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }



    protected function ValidateAllocation()
    {
        return request()->validate(
            [
                'amount'=>'required|integer',
                'state_id'=>'required|string',
                'status'=>'required|string',
            ]
        );
    }
}
