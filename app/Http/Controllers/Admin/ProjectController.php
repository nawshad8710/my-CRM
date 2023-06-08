<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Project;
use Toastr;
use Carbon\Carbon;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!has_access('project_list_view')){
            abort(404);
        }
        $projects = Project::latest()->get();
        if(isset($_GET['status'])){
            $projects = $projects->where('status', $_GET['status']);
        }
        return view('admin.project.list', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!has_access('create_project')){
            abort(404);
        }
        return view('admin.project.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:100',
            'deadline' => 'required',
        ]);

        if(!$request->status || $request->status == NULL){
            $request->status = 0;
        }

        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'status' => $request->status,
        ]);

        Toastr::success('Project Created Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.project.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!has_access('update_project')){
            abort(404);
        }
        $project = Project::findOrFail($id);
        if($project){
            return view('admin.project.form', compact('project'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:100',
            'deadline' => 'required',
        ]);

        $project = Project::findOrFail($id);

        if($project){
            if(!$request->status || $request->status == NULL){
                $request->status = 0;
            }

            $project->update([
                'title' => $request->title,
                'description' => $request->description,
                'deadline' => $request->deadline,
                'status' => $request->status,
            ]);

            Toastr::success('Project Info Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);

            return redirect()->route('admin.project.list');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!has_access('delete_project')){
            abort(404);
        }
        $project = Project::findOrFail($id);
        if($project){
            $project->delete();
            Toastr::success('Project Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        }
        return 1;
    }
}
