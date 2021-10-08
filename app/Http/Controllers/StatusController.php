<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;
use Illuminate\Support\Str;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = Status::all();
        return view('status/status', [
            'status'=>$status
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('status/create-status');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidateStatus();

        try {
            $status = new Status(request([
                'name',
            ]));
            $status->slug = Str::uuid();
            $status->save();
            return back()->with('success', 'New Status Type added  successfully');
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
    public function edit($id)
    {
        $status = Status::where('slug', $id)->first();
        return view('status/edit-status', compact('status'));
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
        $this->ValidateStatus();
        $status = Status::find($request->id);
        $status->update([
            'name' => $request->name,
        ]);
        return redirect(route('status.index'))->with('success', 'New Status Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Status::where('slug',$id)->first();
        if ($status) {
            $status->delete();
            return redirect('/status/list')->with('success', 'Status Type removed!');
        } else {
            return redirect('/status/list')->with('error', 'Status Type  not found');
        }
    }

    public function getDeletedStatus()
    {
        $status = Status::onlyTrashed()->get();
        return view('status.deleted', compact('status'));
    }

    public function restoreDeletedStatus($id)
    {
        try {
            $status = Status::where('slug', $id)->withTrashed()->first();
            $status->restore();
            return redirect(route('status.index'))
                        ->with('success', 'Status restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function permanentlyDeleteStatus($id)
    {
        try {
            $status = Status::where('slug', $id)->withTrashed()->first();
            $status->forceDelete();
            return redirect(route('status.index'))
                    ->with('success', 'Permanently deleted status successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }


    protected function ValidateStatus()
    {
        return request()->validate(
            [
                'name'=>'required|string|unique:statuses',
            ]
        );
    }
}
