<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Indicator;
use App\Welfare;
use Illuminate\Support\Str;

class IndicatorsController extends Controller
{
    public function index()
    {
        $indicators = Indicator::all();
        return view('indicators.dashboard', compact('indicators'));
    }

    public function store(Request $request)
    {
        $this->ValidateTracker();

        try {
            $indicator = new Indicator(request([
                'name',
                'target',
                'upper_limit',
                'borno',
                'adamawa',
                'yobe',
                'comments',
            ]));

            $indicator->save();
            return back()->with('success', 'Indicator added successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function edit($id)
    {
        $indicator = Indicator::find($id);
        return view('indicators.edit', compact(
            'indicator',
        ));
    }

    public function update(Request $request)
    {
        $this->ValidateTracker();
        try {
            $indicator = Indicator::find($request->id);

            // print_r($indicator);
            $indicator->update([
                'name' =>$request->name,
                'target' =>$request->target,
                'upper_limit' =>$request->upper_limit,
                'borno' =>$request->borno,
                'adamawa' =>$request->adamawa,
                'yobe' =>$request->yobe,
                'comments' =>$request->comments,
            ]);

            return redirect(route('indicator.index'))->with('success', 'Indicator has been updated');

            // exit("We got here...3");

        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    protected function ValidateTracker()
    {
        return request()->validate(
            [
                'name' =>'required|string',
                'target' =>'required|string',
                'upper_limit' =>'required|numeric',
                'borno'=>'required|numeric',
                'adamawa' =>'required|numeric',
                'yobe' =>'required|numeric',
                'comments'=>'required|string',
            ]
        );
    }
}
