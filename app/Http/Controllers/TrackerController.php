<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tracker;
use App\Welfare;
use Illuminate\Support\Str;

class TrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracker = Tracker::all();
        return view('trackers.tracker', compact('tracker'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $benefit = Welfare::all();
        return view('trackers.create', compact('benefit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidateTracker();

        try {
            $tracker = new Tracker(request([
                'state_id',
                'indicator',
                'female',
                'male',
                'other'
            ]));
            $tracker->slug = Str::uuid();
            $tracker->save();
            return back()->with('success', 'Indicator added successfully');
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
        $tracker = Tracker::where('slug', $slug)->first();
        $benefit = Welfare::all();
        return view('trackers.tracker-edit', compact('tracker', 'benefit'));
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
        $this->ValidateTracker();
        try {
            $tracker = Tracker::find($request->id);
            $tracker->update([
                'state_id'=>$request->state_id,
                'indicator'=>$request->indicator,
                'female'=>$request->female,
                'male'=>$request->male,
                'other'=>$request->other
            ]);
            return redirect(route('tracker.index'))->with('success', 'Indicator updated successfully');
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
    public function destroy($id)
    {
        $tracker = Tracker::where('slug', $id)->first();
        if ($tracker) {
            $tracker->delete();
            return redirect('/tracker/list')->with('success', 'Indicator removed');
        } else {
            return redirect('/tracker/list')->with('error', 'Indicator not found');
        }
    }
    /**
     *  Route for indicator dashboard
     */
    public function dashboard()
    {
        $indicator = Tracker::all();
        return view('trackers.dashboard', compact('indicator'));
    }

    /**
     *  Get indicator by particular state
     */
    public function state(Request $request)
    {
        $indicator = Tracker::where('state_id', $request->state_id)->get();
        return view('trackers.state', compact('indicator'));
    }

    /**
     * Display single indicator
    */
    public function indicator(Request $request)
    {
        $name =  $request->indicator;
        $indicator = Tracker::where('indicator', $request->indicator)->get();
        return view('trackers.indicator', compact('indicator', 'name'));
    }

    /**
     * Get Deleted indicator
     */
    public function getDeletedIndicator()
    {
        $tracker = Tracker::onlyTrashed()->get();
        return view('trackers.indicator-deleted', compact('tracker'));
    }

    /**
     * Restore Deleted indicator
     */
    public function restoreDeletedIndicator($id)
    {
        try {
            $tracker = Tracker::where('slug', $id)->withTrashed()->first();
            $tracker->restore();
            return redirect(route('tracker.index'))
                        ->with('success', 'Indicator restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Permanently delete indicator
     */
    public function permanentlyDeleteIndicator($id)
    {
        try {
            $tracker = Tracker::where('slug', $id)->withTrashed()->first();
            $tracker->forceDelete();
            return redirect(route('tracker.index'))
                    ->with('success', 'Permanently deleted indicator successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }


    protected function ValidateTracker()
    {
        return request()->validate(
            [
                'state_id'=>'required|string',
                'indicator'=>'required|string',
            ]
        );
    }
}
