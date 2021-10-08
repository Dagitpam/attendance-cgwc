<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sector;

class SectorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectors = Sector::all();
        return view('sector.index', compact('sectors'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sector/create');
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
            $sector = new Sector(request([
                'name',
            ]));

            $sector->save();
            return back()->with('success', 'Sector added  successfully');
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
        $sector = Sector::where('id', $id)->first();
        return view('sector/edit', compact('sector'));
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
        $sector = Sector::find($request->id);
        $sector->update([
            'name' => $request->name
        ]);
        return redirect(route('sectors.index'))->with('success', 'Sector updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sector = Sector::where('id', $id)->first();
        if ($sector) {
            $sector->delete();
            return redirect('/sectors/list')->with('success', 'Sector removed!');
        } else {
            return redirect('/sectors/list')->with('error', 'Sector not found');
        }
    }
}
