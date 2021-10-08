<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Welfare;
use App\Component;
use Illuminate\Support\Str;

class BenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $benefit = Welfare::all();
        return view('benefits/benefits', [
            'benefit'=>$benefit
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $components = Component::all();
        return view('benefits/create-benefit', compact('components'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidateBenefit();

        try {
            $benefit = new Welfare(request([
                'name',
                'component_id',
                'default_number',
            ]));

            // print_r($benefit); exit();

            $benefit->save();
            return back()->with('success', 'New Benefit Type added  successfully');
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
        $benefit = Welfare::where('id', $id)->first();
        $components = Component::all();
        return view('benefits/edit-benefit',compact(
            'benefit',
            'components'
        ));
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
        $this->ValidateBenefit();
        $benefit = Welfare::find($request->id);
        $benefit->update([
            'name' => $request->name,
            'component_id' => $request->component_id,
            'default_number' => $request->number,
        ]);
        return redirect(route('benefit.index'))->with('success','New Benefit Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $benefit = Welfare::where('id',$id)->first();
        if($benefit){
            $benefit->delete();
            return redirect('/benefit/list')->with('success', 'Benefit Type removed!');
        }else{
            return redirect('/benefit/list')->with('error', 'Benefit Type  not found');
        }
    }


    public function getDeletedBenefit()
    {
        $benefit = Welfare::onlyTrashed()->get();
        return view('benefits.deleted', compact('benefit'));
    }

    public function restoreDeletedBenefit($id)
    {
        try {
            $benefit = Welfare::where('slug', $id)->withTrashed()->first();
            $benefit->restore();
            return redirect(route('benefit.index'))
                        ->with('success', 'Benefit restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function permanentlyDeleteBenefit($id)
    {
        try {
            $benefit = Welfare::where('slug', $id)->withTrashed()->first();
            $benefit->forceDelete();
            return redirect(route('benefit.index'))
                    ->with('success', 'Permanently deleted benefit successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }



    protected function ValidateBenefit()
    {
        return request()->validate(
            [
                'name'=>'required|string|',
            ]
        );
    }
}
