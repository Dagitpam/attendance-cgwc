<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Education;
use Illuminate\Support\Str;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $education = Education::all();
        return view('education/education-level', [
            'education'=>$education
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('education/create-education-level');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidateEducation();

        try {
            $education = new Education(request([
                'education_level',
            ]));
            $education->slug = Str::uuid();
            $education->save();
            return back()->with('success', 'Education Level added  successfully');
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
        $education = Education::where('slug', $slug)->first();
        return view('education/edit-education-level', compact('education'));
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
        $this->ValidateEducation();
        $education= Education::find($request->id);
        $education->update([
            'education_level' => $request->education_level,
        ]);
        return redirect(route('education.index'))->with('success', 'Education Level updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $education = Education::where('slug', $id)->first();
        if ($education) {
            $education->delete();
            return redirect('/education/list')->with('success', 'Education Level removed!');
        } else {
            return redirect('/education/list')->with('error', 'Education Level not found');
        }
    }


    public function getDeletedEducation()
    {
        $education = Education::onlyTrashed()->get();
        return view('education.deleted', compact('education'));
    }

    public function restoreDeletedEducation($id)
    {
        try {
            $education = Education::where('slug', $id)->withTrashed()->first();
            $education->restore();
            return redirect(route('education.index'))
                        ->with('success', 'Education level restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function permanentlyDeleteEducation($id)
    {
        try {
            $education = Education::where('slug', $id)->withTrashed()->first();
            $education->forceDelete();
            return redirect(route('education.index'))
                    ->with('success', 'Permanently deleted education level successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }


    protected function ValidateEducation()
    {
        return request()->validate(
            [
                'education_level'=>'required|string',
            ]
        );
    }
}
