<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grm;
use App\State;
use App\Community;
use App\Welfare;
use App\Component;
use Illuminate\Support\Str;

class GrmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Grm::latest()->get();
        return view('grm.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        $communities = Community::all();
        $benefits = Welfare::all();
        $components = Component::all();

        return view('grm.create', compact(
            'states',
            'communities',
            'benefits',
            'components',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateGrm();
        try {
            $report = new Grm(request([
                'state_id',
                'lga_id',
                'community',
                'activity',
                'benefit_id',
                'component_id',
                'brief_grieviance',
                'date_report',
                'status_griviance',
                'date_resolution',
                'brief_conclusion',
                'level_resolution',
                'reported_by',
            ]));
            $report->slug = Str::uuid();
            $report->save();
            return back()->with('success', 'Report Added successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Grm $report)
    {
        return view('grm.reports-show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Grm::where('id', $id)->first();
        $communities = Community::all();
        $benefit = Welfare::all();
        return view('grm.reports-edit', compact('report', 'communities', 'benefit'));
    }

    /**
     * Update the specified resource in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->ValidateGrm();
        try {
            $report = Grm::find($request->id);
            $report->update([
                'state_id'=>$request->state_id,
                'lga_id'=>$request->lga_id,
                'community'=>$request->community,
                'lga_id'=>$request->lga_id,
                'activity'=>$request->activity,
                'benefit_id'=>$request->benefit_id,
                'component_id'=>$request->component,
                'brief_grieviance'=>$request->brief_grieviance,
                'date_report'=>$request->date_report,
                'status_griviance'=>$request->status_griviance,
                'date_resolution'=>$request->date_resolution,
                'brief_conclusion'=>$request->brief_conclusion,
                'level_resolution'=>$request->level_resolution,
                'reported_by'=>$request->reported_by,
            ]);

            //$request->file('photo')->store('public/images');
            return redirect(route('grm.index'))->with('success', 'Reports updated successfully');
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
        $report = Grm::where('id', $id)->first();
        if ($report) {
            $report->delete();
            return redirect('/grm/list')->with('success', 'Report removed');
        } else {
            return redirect('/grm/list')->with('error', 'Report not found');
        }
    }

    /**
    * Get Deleted indicator Report
    */
    public function getDeletedGrm()
    {
        $reports = Grm::onlyTrashed()->get();
        return view('grm.report-deleted', compact('reports'));
    }

    /**
     * Restore Deleted indicator Report
     */
    public function restoreDeletedGrm($id)
    {
        try {
            $reports = Grm::where('id', $id)->withTrashed()->first();
            $reports->restore();
            return redirect(route('grm.index'))
                        ->with('success', 'Grm report restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Permanently delete indicator
     */
    public function permanentlyDeleteGrm($id)
    {
        try {
            $reports = Grm::where('id', $id)->withTrashed()->first();
            $reports->forceDelete();
            return redirect(route('grm.index'))
                    ->with('success', 'Permanently deleted Grm report successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    protected function ValidateGrm()
    {
        return request()->validate([
        'state_id'=>'required',
        'lga_id'=>'required',
        'community'=>'required|string',
        'activity'=>'required|string',
        'indicator'=>'required|string',
        'component'=>'required|string',
        'brief_grieviance'=>'required|string',
        'date_report'=>'required|date',
        'status_griviance'=>'required|string',
        'date_resolution'=>'required|date',
        'brief_conclusion'=>'required|string',
        'level_resolution'=>'required|string',
        'reported_by'=>'required|string',
        ]);
    }
}
