<?php

namespace App\Http\Controllers;

use App\Scorecard;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ScorecardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scorecard = Scorecard::all();
        return view('scorecard.index', compact('scorecard'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('scorecard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidateScorecard();

        try {
            $scorecard = new Scorecard(request([
                'category',
                'component_one',
                'component_two',
                'safeguards',
                'm_e',
                'performance',
                'state_id',
            ]));
            $scorecard->slug = Str::uuid();
            $scorecard->save();
            return back()->with('success', 'Scorecard added successfully');
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
        $scorecard = Scorecard::where('slug', $slug)->first();
        return view('scorecard.edit', compact('scorecard'));
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
        $this->ValidateScorecard();
        try {
            $scorecard = Scorecard::find($request->id);
            $scorecard->update([
                'category'=>$request->category,
                'component_one'=>$request->component_one,
                'component_two'=>$request->component_two,
                'safeguards'=>$request->safeguards,
                'm_e'=>$request->m_e,
                'performance'=>$request->performance,
                'state_id'=>$request->state_id,
            ]);
            return redirect(route('scorecard.index'))->with('success', 'Scorecard updated successfully');
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
        $scorecard = Scorecard::where('slug', $slug)->first();
        if ($scorecard) {
            $scorecard->delete();
            return redirect('/scorecard/list')->with('success', 'Scorecard removed');
        } else {
            return redirect('/scorecard/list')->with('error', 'Scorecard not found');
        }
    }

    /**
     * Get Deleted Scorecard
     */
    public function getDeletedScorecard()
    {
        $scorecard = Scorecard::onlyTrashed()->get();
        return view('scorecard.delete', compact('scorecard'));
    }

    /**
     * Restore Deleted class
     */
    public function restoreDeletedScorecard($slug)
    {
        try {
            $scorecard = Scorecard::where('slug', $slug)->withTrashed()->first();
            $scorecard->restore();
            return redirect(route('scorecard.index'))
                        ->with('success', 'Scorecard restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Permanently delete indicator
     */
    public function permanentlyDeleteScorecard($slug)
    {
        try {
            $scorecard = Scorecard::where('slug', $slug)->withTrashed()->first();
            $scorecard->forceDelete();
            return redirect(route('scorecard.index'))
                    ->with('success', 'Permanently deleted scorecard successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }



    protected function ValidateScorecard()
    {
        return request()->validate(
            [
                'category'=>'required|string',
                'component_one'=>'required|integer',
                'component_two'=>'required|integer',
                'safeguards'=>'required|integer',
                'm_e'=>'required|integer',
                'performance'=>'required|integer',
                'state_id'=>'required|integer'
            ]
        );
    }
}
