<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Project;
use App\Models\User;
use App\Models\Admin\UserProject;
use Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_projects = UserProject::where('user_id', Auth::user()->id)->latest()->get();
       
        if(isset($_GET['status'])){
            $user_projects = $user_projects->where('status', $_GET['status']);
        }
        return view('employee.user_project.list', compact('user_projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = User::where('role',1)->where('status',1)->get();
        $projects = Project::where('status','!=' ,2)->where('status','!=' ,3)->latest()->get();
        
        return view('employee.user_project.form', compact('employees', 'projects'));
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
            'user_id' => 'required',
            'project_id' => 'required',
            'task' => 'required',
            'deadline' => 'required',
        ]);

        if(!$request->status || $request->status == NULL){
            $request->status = 0;
        }else{
            $request->status = 1;
        }

        UserProject::create([
            'user_id' => $request->user_id,
            'project_id' => $request->project_id,
            'task' => $request->task,
            'deadline' => $request->deadline,
            'status' => $request->status,
        ]);

        Toastr::success('Assignment Added Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('employee.assignment.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAssignmentsByProject($id)
    {
        $assignments = UserProject::where('project_id', $id)->where('user_id', Auth::user()->id)->where('status','!=' ,2)->where('status','!=' ,3)->latest()->get();

        return json_decode($assignments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assignment = UserProject::findOrFail($id);
        $employees = User::where('role',1)->where('status',1)->get();
        $projects = Project::where('status','!=' ,2)->where('status','!=' ,3)->latest()->get();

        if($assignment){
            return view('employee.user_project.form', compact('assignment','employees', 'projects'));
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
            'user_id' => 'required',
            'project_id' => 'required',
            'task' => 'required',
            'deadline' => 'required',
        ]);

        $assignment = UserProject::findOrFail($id);

        if($assignment){
            if(!$request->status || $request->status == NULL){
                $request->status = 0;
            }else{
                $request->status = 1;
            }

            $assignment->update([
                'user_id' => $request->user_id,
                'project_id' => $request->project_id,
                'task' => $request->task,
                'deadline' => $request->deadline,
                'status' => $request->status,
            ]);

            Toastr::success('Assignment Info Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);

            return redirect()->route('employee.assignment.list');
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
        $assignment = UserProject::findOrFail($id);
        if($assignment){
            $assignment->delete();
            Toastr::success('Assignment Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        }
        return 1;
    }
}
