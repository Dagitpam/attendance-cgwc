<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Communication;

class CommunicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $communication = Communication::all();
        return view('communications.index', compact('communication'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('communications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidateCommunication();

        try {
            $communication = new Communication(request([
                'number',
                'state_id',
            ]));
            $communication->slug = Str::uuid();
            $communication->save();
            return back()->with('success', 'Total communication publicationn by state added successfully');
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
        $communication = Communication::where('slug', $slug)->first();
        return view('communications.edit', compact('communication'));
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
        $this->ValidateCommunication();
        try {
            $communication = Communication::find($request->id);
            $communication->update([
                'number'=>$request->number,
                'state_id'=>$request->state_id,
            ]);
            return redirect(route('communication.index'))->with('success', 'Communication publication updated successfully');
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
        $communication = Communication::where('id', $id)->first();
        if ($communication) {
            $communication->delete();
            return redirect('/communication/list')->with('success', 'Communication removed');
        } else {
            return redirect('/communication/list')->with('error', 'Communication not found');
        }
    }

    /**
     * Get Deleted Communication
     */
    public function getDeletedCommunication()
    {
        $communication = Communication::onlyTrashed()->get();
        return view('communications.delete', compact('communication'));
    }

    /**
     * Restore Deleted Communication
     */
    public function restoreDeletedCommunication($id)
    {
        try {
            $communication = Communication::where('id', $id)->withTrashed()->first();
            $communication->restore();
            return redirect(route('communication.index'))
                        ->with('success', 'Communication restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Permanently delete Communication
     */
    public function permanentlyDeleteCommunication($slug)
    {
        try {
            $communication = Communication::where('slug', $slug)->withTrashed()->first();
            $communication->forceDelete();
            return redirect(route('communication.index'))
                    ->with('success', 'Permanently deleted communication publication successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }



    protected function ValidateCommunication()
    {
        return request()->validate(
            [
                'number'=>'required|integer',
                'state_id'=>'required',
            ]
        );
    }
}
