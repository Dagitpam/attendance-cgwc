<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Investment;
use Illuminate\Support\Str;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $investment = Investment::all();
        return view('investments.investment', compact('investment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('investments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidateInvestment();

        try {
            $investment = new Investment(request([
                'amount',
                'type',
                'category',
                'state_id'
            ]));
            $investment->slug = Str::uuid();
            $investment->save();
            return back()->with('success', 'Investment added successfully');
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
        $investment = Investment::where('slug', $slug)->first();
        return view('investments.edit', compact('investment'));
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
        $this->ValidateInvestment();
        try {
            $investment = Investment::find($request->id);
            $investment->update([
                'amount'=>$request->amount,
                'type'=>$request->type,
                'category'=>$request->category,
                'state_id'=>$request->state_id,
            ]);
            return redirect(route('investment.index'))->with('success', 'Investment updated successfully');
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
        $investment = Investment::where('slug', $slug)->first();
        if ($investment) {
            $investment->delete();
            return redirect('/investment/list')->with('success', 'Investment removed');
        } else {
            return redirect('/investment/list')->with('error', 'Investment not found');
        }
    }

    /**
     * Get Deleted allocatio
     */
    public function getDeletedInvestment()
    {
        $investment = Investment::onlyTrashed()->get();
        return view('investments.deleted', compact('investment'));
    }

    /**
     * Restore Deleted indicator
     */
    public function restoreDeletedInvestment($slug)
    {
        try {
            $investment = Investment::where('slug', $slug)->withTrashed()->first();
            $investment->restore();
            return redirect(route('investment.index'))
                        ->with('success', 'Investment restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Permanently delete indicator
     */
    public function permanentlyDeleteInvestment($slug)
    {
        try {
            $investment = Investment::where('slug', $slug)->withTrashed()->first();
            $investment->forceDelete();
            return redirect(route('investment.index'))
                    ->with('success', 'Permanently deleted investment successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }



    protected function ValidateInvestment()
    {
        return request()->validate(
            [
                'amount'=>'required|integer',
                'type'=>'required|string',
                'category'=>'required|string',
                'state_id'=>'required'
            ]
        );
    }
}
