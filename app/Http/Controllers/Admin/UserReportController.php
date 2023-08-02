<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Project;
use App\Models\User;
use App\Models\Admin\UserProject;
use App\Models\Admin\UserReport;
use Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!has_access('employee_task_report_list_view')){
            abort(404);
        }
        
        $reports = UserReport::latest()->get();
        //$employees = User::where('role',1)->where('status',1)->get();
        $employees = User::leftJoin('roles', function ($join) {
                    $join->on('roles.id', '=', 'users.role_id');
                    })
                    ->where('roles.type', 1)
                    ->select('users.*', 'roles.type')
                    ->get();
        $projects = Project::where('status','!=' ,2)->where('status','!=' ,3)->latest()->get();

        if(isset($_GET['user_id'])){
            $reports = $reports->where('user_id', $_GET['user_id']);
        }

        if(isset($_GET['project_id'])){
            $reports = $reports->where('project_id', $_GET['project_id']);
        }

        return view('admin.user_report.list', compact('reports', 'employees', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
