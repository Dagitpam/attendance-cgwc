<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Classroom;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class = Classroom::all();
        return view('class.index', compact('class'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('class.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidateClass();

        try {
            $class = new Classroom(request([
                'name',
                'address',
                'number',
                'state_id',
                'status'
            ]));
            $class->slug = Str::uuid();
            $class->save();
            return back()->with('success', 'Classroom added successfully');
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
        $class = Classroom::where('slug', $slug)->first();
        return view('class.edit', compact('class'));
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
        $this->ValidateClass();
        try {
            $class = Classroom::find($request->id);
            $class->update([
                'name'=>$request->name,
                'address'=>$request->address,
                'number'=>$request->number,
                'state_id'=>$request->state_id,
                'status'=>$request->status,
            ]);
            return redirect(route('class.index'))->with('success', 'Classroom updated successfully');
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
        $class = Classroom::where('slug', $slug)->first();
        if ($class) {
            $class->delete();
            return redirect('/class/list')->with('success', 'Classroom removed');
        } else {
            return redirect('/class/list')->with('error', 'Classroom not found');
        }
    }

    /**
     * Get Deleted Classroom
     */
    public function getDeletedClass()
    {
        $class = Classroom::onlyTrashed()->get();
        return view('class.delete', compact('class'));
    }

    /**
     * Restore Deleted class
     */
    public function restoreDeletedClass($slug)
    {
        try {
            $class = Classroom::where('slug', $slug)->withTrashed()->first();
            $class->restore();
            return redirect(route('class.index'))
                        ->with('success', 'Classroom restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Permanently delete indicator
     */
    public function permanentlyDeleteClass($slug)
    {
        try {
            $class = Classroom::where('slug', $slug)->withTrashed()->first();
            $class->forceDelete();
            return redirect(route('class.index'))
                    ->with('success', 'Permanently deleted classroom successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }



    protected function ValidateClass()
    {
        return request()->validate(
            [
                'name'=>'required|string',
                'address'=>'required|string',
                'number'=>'required|integer',
                'state_id'=>'required',
                'status'=>'required|string'
            ]
        );
    }
}
