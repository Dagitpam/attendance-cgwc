<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\School;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school = School::all();
        return view('schools.index', compact('school'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schools.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidateSchool();

        try {
            $school = new School(request([
                'name',
                'address',
                'state_id',
                'status'
            ]));
            $school->slug = Str::uuid();
            $school->save();
            return back()->with('success', 'Renovated School added successfully');
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
        $school = School::where('slug', $slug)->first();
        return view('schools.edit', compact('school'));
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
        $this->ValidateSchool();
        try {
            $school = School::find($request->id);
            $school->update([
                'name'=>$request->name,
                'address'=>$request->address,
                'state_id'=>$request->state_id,
                'status'=>$request->status,
            ]);
            return redirect(route('school.index'))->with('success', 'Renovated School updated successfully');
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
        $school = School::where('slug', $slug)->first();
        if ($school) {
            $school->delete();
            return redirect('/school/list')->with('success', 'School removed');
        } else {
            return redirect('/school/list')->with('error', 'School not found');
        }
    }

    /**
     * Get Deleted allocatio
     */
    public function getDeletedSchool()
    {
        $school = School::onlyTrashed()->get();
        return view('schools.delete', compact('school'));
    }

    /**
     * Restore Deleted school
     */
    public function restoreDeletedSchool($slug)
    {
        try {
            $school = School::where('slug', $slug)->withTrashed()->first();
            $school->restore();
            return redirect(route('school.index'))
                        ->with('success', 'School restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Permanently delete indicator
     */
    public function permanentlyDeleteSchool($slug)
    {
        try {
            $school = School::where('slug', $slug)->withTrashed()->first();
            $school->forceDelete();
            return redirect(route('school.index'))
                    ->with('success', 'Permanently deleted school successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }



    protected function ValidateSchool()
    {
        return request()->validate(
            [
                'name'=>'required|string',
                'address'=>'required|string',
                'state_id'=>'required',
                'status'=>'required|string'
            ]
        );
    }
}
