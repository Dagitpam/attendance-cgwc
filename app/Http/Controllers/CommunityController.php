<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\State;
use App\Lga;
use App\Community;
use Illuminate\Support\Str;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $community = Community::all();
        return view('communities/communities', [
            'community'=>$community
        ]);
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
        return view('communities/create-community', compact('states', 'lgas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidateCommunity();

        try {
            $community = new Community(request([
                'name',
                'longtitude',
                'latitude',
                'state_id',
                'lga_id'
            ]));
            $community->slug = Str::uuid();
            $community->save();
            return back()->with('success', 'Community added  successfully');
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
        $community = Community::where('slug', $id)->first();
        $states = State::all();
        $lgas = Lga::all();
        return view('communities/community-edit', compact('community', 'states'));
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
        $this->ValidateCommunity();
        $community   = Community::find($request->id);
        $community->update([
            'name' => $request->name,
            'longtitude'=>$request->longtitude,
            'latitude'=>$request->latitude,
            'state_id'=>$request->state_id,
            'lga_id'=>$request->lga_id,
        ]);
        return redirect(route('community.index'))->with('success', 'Community updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $community = Community::where('slug', $id)->first();
        if ($community) {
            $community->delete();
            return redirect('/community/list')->with('success', 'Community removed!');
        } else {
            return redirect('/community/list')->with('error', 'Community not found');
        }
    }


    public function getDeletedCommunity()
    {
        $community = Community::onlyTrashed()->get();
        return view('communities.deleted', compact('community'));
    }

    public function restoreDeletedCommunity($id)
    {
        try {
            $community = Community::where('id', $id)->withTrashed()->first();
            $community->restore();
            return redirect(route('community.index'))
                        ->with('success', 'Community restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function permanentlyDeleteCommunity($id)
    {
        try {
            $community = Community::where('id', $id)->withTrashed()->first();
            $community->forceDelete();
            return redirect(route('community.index'))
                    ->with('success', 'Permanently deleted community successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }


    protected function ValidateCommunity()
    {
        return request()->validate(
            [
                'name'=>'required|string',
                'longtitude'=>'required|string',
                'latitude'=>'required|string',
                'state_id'=>'required|string',
                'lga_id'=>'required|string'
            ]
        );
    }
}
