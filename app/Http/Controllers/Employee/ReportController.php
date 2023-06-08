<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Project;
use App\Models\User;
use App\Models\Admin\UserProject;
use App\Models\Admin\UserReport;
use Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = UserReport::where('user_id', Auth::user()->id)->latest()->get();

        return view('employee.user_report.list', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = UserProject::where('user_id', Auth::user()->id)->where('status','!=' ,2)->where('status','!=' ,3)->latest()->get();
        
        return view('employee.user_report.form', compact('projects'));
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
            'project_id' => 'required',
            'user_project_id' => 'required',
            'description' => 'required',
            'spent_time' => 'required|string|max:100',
        ]);

        $report = UserReport::create([
            'user_id' => Auth::user()->id,
            'project_id' => $request->project_id,
            'user_project_id' => $request->user_project_id,
            'description' => $request->description,
            'spent_time' => $request->spent_time,
        ]);

        $imageName = '';
        $image = $request->file('photo');
        if($image){
            $currentDate = Carbon::now()->toDateString();
            $imageName   = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            

            if (!file_exists('assets/images/uploads/reports')) {
                mkdir('assets/images/uploads/reports', 0777, true);
            }
            $image->move(public_path('assets/images/uploads/reports'), $imageName);
            //$image->move(base_path().'/assets/images/uploads/reports', $imageName);

            $report->photo = $imageName;
            $report->save();
        }

        Toastr::success('Report Added Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('employee.report.list');
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
        $report = UserReport::findOrFail($id);
        $projects = UserProject::where('user_id', Auth::user()->id)->where('status','!=' ,2)->where('status','!=' ,3)->latest()->get();

        if($report && $report->project->status==1 && $report->user_project->status==1){
            $tasks = UserProject::where('project_id', $report->project_id)->where('user_id', Auth::user()->id)->where('status','!=' ,2)->where('status','!=' ,3)->latest()->get();
            return view('employee.user_report.form', compact('report', 'projects', 'tasks'));
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
        $report = UserReport::findOrFail($id);
        if($report && $report->project->status==1 && $report->user_project->status==1){
            $validated = $request->validate([
                'project_id' => 'required',
                'user_project_id' => 'required',
                'description' => 'required',
                'spent_time' => 'required|string|max:100',
            ]);
    
            $report->update([
                'user_id' => Auth::user()->id,
                'project_id' => $request->project_id,
                'user_project_id' => $request->user_project_id,
                'description' => $request->description,
                'spent_time' => $request->spent_time,
            ]);
    
            $imageName = $report->photo;
            $image = $request->file('photo');
            if($image){
                $currentDate = Carbon::now()->toDateString();
                $imageName   = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                
    
                if (!file_exists('assets/images/uploads/reports')) {
                    mkdir('assets/images/uploads/reports', 0777, true);
                }
                $image->move(public_path('assets/images/uploads/reports'), $imageName);
                //$image->move(base_path().'/assets/images/uploads/reports', $imageName);

                //dd(base_path().'/assets/images/uploads/reports');
    
                $report->photo = $imageName;
                $report->save();
            }
    
            Toastr::success('Report Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
    
            return redirect()->route('employee.report.list');
        }else{
            Toastr::error("This report can't be updated!", 'Failed', ["positionClass" => "toast-top-right"]);
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
        $report = UserReport::findOrFail($id);
        if($report && $report->project->status==1 && $report->user_project->status==1){
            $report->delete();
            Toastr::success('Report Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        }else{
            Toastr::error("This report can't be deleted!", 'Failed', ["positionClass" => "toast-top-right"]);
        }
        return 1;
    }
}
