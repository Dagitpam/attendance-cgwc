<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Component;
use Illuminate\Support\Str;

class ComponentController extends Controller
{
    //

    public function index(){
        $components = Component::all();
        return view('components/component', [
            'components' => $components,
        ]);
    }

    public function store(Request $request)
    {
        $this->ValidateComponent();

        try {
            $component = new Component(request(['name', 'description']));
            $component->save();
            return back()->with('success', 'New component created successfully');
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
        $component = Component::where('id', $id)->first();
        return view('components/edit',compact('component'));
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
        $this->ValidateComponent();
        $component = Component::find($request->id);
        $component->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect(route('components'))->with('success','Component updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $component = Component::where('id',$id)->first();
        if($component){
            $component->delete();
            return redirect('/components')->with('success', 'Component deleted!');
        }else{
            return redirect('/components')->with('error', 'Component not found');
        }
    }



    protected function ValidateComponent()
    {
        return request()->validate(
            [
                'name'=>'required|string|',
            ]
        );
    }
}
