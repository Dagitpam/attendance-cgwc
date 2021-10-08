<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Training;

class TrainingController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $training = Training::all();
        return view('training.training', compact('training'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('training.create');
    }

    /**
     * Store a newly created resource in storage.a
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidateTraining();

        try {
            $training = new Training(request([
                'name',
                'state_id',
                'training_type',
                'duration'
            ]));
            $training->slug = Str::uuid();
            $training->save();
            return back()->with('success', 'Trainee successfully');
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
        $training = Training::where('slug', $slug)->first();
        return view('training.edit', compact('training'));
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
        $this->ValidateTraining();
        try {
            $training = Training::find($request->id);
            $training->update([
                'name'=>$request->name,
                'state_id'=>$request->state_id,
                'training_type'=>$request->training_type,
                'duration'=>$request->duration
            ]);
            return redirect(route('training.index'))->with('success', 'Trainee  updated successfully');
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
        $training = Training::where('slug', $slug)->first();
        if ($training) {
            $training->delete();
            return redirect('/training/list')->with('success', 'Trainee  removed');
        } else {
            return redirect('/training/list')->with('error', 'Trainee not found');
        }
    }

    /**
     * Get Deleted training group
     */
    public function getDeletedTraining()
    {
        $training = Training::onlyTrashed()->get();
        return view('training.delete', compact('training'));
    }

    /**
     * Restore Deleted training group
     */
    public function restoreDeletedTraining($slug)
    {
        try {
            $training = Training::where('slug', $slug)->withTrashed()->first();
            $training->restore();
            return redirect(route('training.index'))
                        ->with('success', 'Trainee restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Permanently delete training group
     */
    public function permanentlyDeleteTraining($slug)
    {
        try {
            $training =Training::where('slug', $slug)->withTrashed()->first();
            $training->forceDelete();
            return redirect(route('training.index'))
                    ->with('success', 'Permanently deleted trainee successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    protected function ValidateTraining()
    {
        return request()->validate(
            [
                'name'=>'required|string',
                'state_id'=>'required',
                'training_type'=>'required|string',
                'duration'=>'required|string'
            ]
        );
    }
}
