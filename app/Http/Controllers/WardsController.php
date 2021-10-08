<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ward;
use App\Lga;
use App\State;
use Illuminate\Support\Str;

class WardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wards = Ward::all();
        return view('ward.index', compact('wards'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        $lgas = Lga::all();
        return view('ward/create', compact('lgas', 'states'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $ward = new Ward(request([
                'lga_id',
                'name'
            ]));

            $ward->save();
            return back()->with('success', 'Ward added  successfully');
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
        $ward = Ward::where('id', $id)->first();
        $states = State::all();
        $lgas = Lga::all();
        return view('ward/edit', compact('ward', 'states', 'lgas'));
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
        $ward = Ward::find($request->id);
        $ward->update([
            'lga_id'=>$request->lga_id,
            'name' => $request->name
        ]);
        return redirect(route('wards.index'))->with('success', 'Ward updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ward = Ward::where('id', $id)->first();
        if ($ward) {
            $ward->delete();
            return redirect('/wards/list')->with('success', 'Ward removed!');
        } else {
            return redirect('/wards/list')->with('error', 'Ward not found');
        }
    }

}
