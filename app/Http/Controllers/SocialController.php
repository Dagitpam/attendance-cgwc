<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Social;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $social = Social::all();
        return view('socials.social', compact('social'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('socials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidateSocial();

        try {
            $social = new Social(request([
                'number',
                'state_id',
                'participant_type',
            ]));
            $social->slug = Str::uuid();
            $social->save();
            return back()->with('success', 'Social activity added successfully');
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
        $social = Social::where('slug', $slug)->first();
        return view('socials.edit', compact('social'));
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
        $this->ValidateSocial();
        try {
            $social = Social::find($request->id);
            $social->update([
                'number'=>$request->number,
                'state_id'=>$request->state_id,
                'participant_type'=>$request->participant_type
            ]);
            return redirect(route('social.index'))->with('success', 'Social activity updated successfully');
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
        $social = Social::where('slug', $slug)->first();
        if ($social) {
            $social->delete();
            return redirect('/social/list')->with('success', 'Social activity removed');
        } else {
            return redirect('/social/list')->with('error', 'Social activity not found');
        }
    }

    /**
     * Get Deleted social activity
     */
    public function getDeletedSocial()
    {
        $social = Social::onlyTrashed()->get();
        return view('socials.delete', compact('social'));
    }

    /**
     * Restore Deleted social activity
     */
    public function restoreDeletedSocial($slug)
    {
        try {
            $social = Social::where('slug', $slug)->withTrashed()->first();
            $social->restore();
            return redirect(route('social.index'))
                        ->with('success', 'Social activity restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Permanently delete social activity
     */
    public function permanentlyDeleteSocial($slug)
    {
        try {
            $social =Social::where('slug', $slug)->withTrashed()->first();
            $social->forceDelete();
            return redirect(route('social.index'))
                    ->with('success', 'Permanently deleted socail activity successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    protected function ValidateSocial()
    {
        return request()->validate(
            [
                'number'=>'required|integer',
                'state_id'=>'required',
                'participant_type'=>'required|string'
            ]
        );
    }
}
