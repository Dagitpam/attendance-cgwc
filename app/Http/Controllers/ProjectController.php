<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Project;
use App\Community;
use App\Component;
use App\Project_category;
use App\Project_sub_category;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::latest()->get();
        // GET projects by components
        $c1_projects = Project::where('component_id', 1)->count();
        $c2_projects = Project::where('component_id', 2)->count();
        $c3_projects = Project::where('component_id', 3)->count();
        $all_projects = Project::all()->count();

        // exit($c3_projects);

        // GET projects by states
        $borno_projects = Project::where('state_id', 8)->count();
        $adamawa_projects = Project::where('state_id', 2)->count();
        $yobe_projects = Project::where('state_id', 35)->count();

        // GET projects by status
        $functional_projects = Project::where('status_id', 1)->count();
        $completed_projects = Project::where('status_id', 2)->count();
        $non_functional_projects = Project::where('status_id', 3)->count();

        // get state percentages
        $borno_percent = $this->get_percentage($borno_projects, $all_projects);
        $adamawa_percent = $this->get_percentage($adamawa_projects, $all_projects);
        $yobe_percent = $this->get_percentage($yobe_projects, $all_projects);

        // get components percentages
        $c1_percent = $this->get_percentage($c1_projects, $all_projects);
        $c2_percent = $this->get_percentage($c2_projects, $all_projects);
        $c3_percent = $this->get_percentage($c3_projects, $all_projects);

        // get status percentages
        $functional_percent = $this->get_percentage($functional_projects, $all_projects);
        $non_functional_percent = $this->get_percentage($non_functional_projects, $all_projects);
        $completed_percent = $this->get_percentage($completed_projects, $all_projects);


        return view('projects.project',
        compact(
            'project',
            'all_projects',
            'c1_projects',
            'c2_projects',
            'c3_projects',
            'borno_projects',
            'adamawa_projects',
            'yobe_projects',
            'functional_projects',
            'completed_projects',
            'non_functional_projects',
            'borno_percent',
            'adamawa_percent',
            'yobe_percent',
            'c1_percent',
            'c2_percent',
            'c3_percent',
            'functional_percent',
            'non_functional_percent',
            'completed_percent',
        ));
    }

    public function get_percentage($part, $whole){
        if($part == 0 || $whole == 0){
            return 0;
        }else{
            return $part/$whole*100;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $community = Community::all();
        $components = Component::all();
        $categories = Project_Category::all();

        return view('projects.create', compact(
            'community',
            'components',
            'categories'
        ));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
     //$this->ValidateProject();
    //    $this->validate($request,
    //         [
    //             'description'=>'string',
    //             'state_id'=>'required',
    //             'status_id'=>'required',
    //             'sub_category'=>'required',
    //             'category_id'=>'required',
    //             'component_id'=>'required',
    //             'amount'=>'required|integer',
    //             'number'=>'required',
    //             'lga_id'=>'required'
    //         ]
    //         );
        try {
            $project = new Project(request([
                'category_id',
                'sub_category',
                'status_id',
                'why_not_functional',
                'amount_disbursed',
                'amount_spend',
                'number',
                'state_id',
                'lga_id',
                'community_id',
                'location',
                'longtitude',
                'latitude',
                'description',
            ]));
            $project->component_id = $request->component_id;
            $project->save();
            return back()->with('success', 'Project created successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display Projects by location
    */
    public function show($id)
    {
        $project = Project::where('id', $id)->first();
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::where('id', $id)->first();
        $community = Community::all();
        $components = Component::all();
        $categories = Project_Category::all();
        return view('projects.edit', compact(
            'project',
            'community',
            'components',
            'categories'
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
        // $this->ValidateProject();
        $this->validate($request,
            [
                'description'=>'string',
                'state_id'=>'required',
                'status_id'=>'required',
                'sub_category'=>'required',
                'category_id'=>'required',
                'component_id'=>'required',
                'amount'=>'required|integer',
                'number'=>'required',
                'lga_id'=>'required'
            ]
            );
        try {
            $project = Project::find($request->id);
            $project->update([
                'component_id' =>$request->component_id,
                'category_id' =>$request->category_id,
                'sub_category' =>$request->sub_category,
                'status_id' =>$request->status_id,
                'why_not_functional' =>$request->why_not_functional,
                'amount_disbursed'=>$request->amount_disbursed,
                'amount_spend'=>$request->amount_spend,
                'number'=>$request->number,
                'state_id'=>$request->state_id,
                'lga_id' =>$request->lga_id,
                'community_id' =>$request->community_id,
                'location' =>$request->location,
                'longtitude'=>$request->longtitude,
                'latitude'=>$request->latitude,
                'description' =>$request->description,
            ]);
            return redirect(route('project.index'))->with('success', 'Project updated successfully');
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
        $project = Project::where('id', $id)->first();
        if ($project) {
            $project->delete();
            return redirect('/project/list')->with('success', 'Project removed');
        } else {
            return redirect('/project/list')->with('error', 'Project not found');
        }
    }

    /**
     * Get project by location
    */
    public function ProjectLocation($community)
    {
        $project = Project::where('community_id', $community)->get();
        return view('projects.location', compact('project'));
    }

    /**
     * Get Deleted project
     */
    public function getDeletedProject()
    {
        $project = Project::onlyTrashed()->get();
        return view('projects.delete', compact('project'));
    }

    /**
     * Restore Deleted project
     */
    public function restoreDeletedProject($slug)
    {
        try {
            $project = Project::where('slug', $slug)->withTrashed()->first();
            $project->restore();
            return redirect(route('project.index'))
                        ->with('success', 'Project restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Permanently delete project
     */
    public function permanentlyDeleteProject($slug)
    {
        try {
            $project = Project::where('slug', $slug)->withTrashed()->first();
            $project->forceDelete();
            return redirect(route('project.index'))
                    ->with('success', 'Permanently deleted project successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display project locations on a map
     */
    public function maps()
    {
        $projects = Project::all();
        $components = Component::all();
        return view('projects.maps', compact('projects', 'components'));
    }


    protected function ValidateProject()
    {
        return request()->validate(
            [
                'description'=>'string',
                'state_id'=>'required',
                'status_id'=>'required',
                'sub_category'=>'required',
                'category_id'=>'required',
                'component_id'=>'required',
                'number'=>'required'
            ]
        );
    }

    // categories

    public function categories(){
        $categories = Project_category::all();
        return view('projects.category', compact('categories'));
    }

    public function store_category(Request $request){

        try {
            $project = new Project_category(request([
                'name',
            ]));
            $project->save();
            return back()->with('success', 'Category created successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function edit_category($id){
        $category = Project_category::where('id', $id)->first();
        return view('projects.edit-category', compact('category'));
    }

    public function update_category(Request $request){
        // $this->ValidateProject();
        try {

            // print_r($request); exit();

            $project_category = Project_category::find($request->id);
            $project_category->update([
                'name'=>$request->name
            ]);
            return redirect(route('categories.index'))->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function destroy_category($id)
    {
        $project_category = Project_category::where('id', $id)->first();
        if ($project_category) {
            $project_category->delete();
            return redirect('/project/categories')->with('success', 'Project category removed');
        } else {
            return redirect('/project/categories')->with('error', 'Project category not found');
        }
    }

    // sub categories

    public function sub_categories(){
        $sub_categories = Project_sub_category::all();
        $categories = Project_category::all();
        return view('projects.sub-category', compact('sub_categories', 'categories'));
    }

    public function store_sub_category(Request $request){

        try {

            $sub_categories = new Project_sub_category(request([
                'name',
                'project_category_id'
            ]));

            // print_r($project); exit();

            $sub_categories->save();

            return back()->with('success', 'Sub category created successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function edit_sub_category($id){
        $sub_category = Project_sub_category::where('id', $id)->first();
        $categories = Project_category::all();
        return view('projects.edit-sub-category', compact('sub_category', 'categories'));
    }

    public function update_sub_category(Request $request){
        // $this->ValidateProject();
        try {

            $project_category = Project_sub_category::find($request->id);
            $project_category->update([
                'name'=>$request->name,
                'project_category_id'=>$request->project_category_id,
            ]);
            return redirect(route('subcategories.index'))->with('success', 'Sub category updated successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function destroy_sub_category($id)
    {
        $project_category = Project_sub_category::where('id', $id)->first();
        if ($project_category) {
            $project_category->delete();
            return redirect('/project/sub-categories')->with('success', 'Sub category removed');
        } else {
            return redirect('/project/sub-categories')->with('error', 'Sub category not found');
        }
    }

    /**
     * Get sub categories that belong to particular category
     */
    public function getSubCategories(Request $request)
    {
        // print_r($request); exit();
        $data['sub_category'] = Project_sub_category::where("project_category_id", $request->category_id)
        ->get(["name","id"]);
        return response()->json($data);
    }


}
