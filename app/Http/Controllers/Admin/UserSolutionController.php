<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Problem;
use App\Models\Admin\Project;
use App\Models\Admin\Solution;
use App\Models\Admin\UserProject;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class UserSolutionController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | INDEX (METHOD)
    |--------------------------------------------------------------------------
    */
    public function soluitonIndex()
    {
        if (!has_access('view_solution')) {
            abort(404);
        }


        $solutions = Solution::latest()
            ->get();


        $employees = User::whereHas('role', function ($query) {
            $query->where('type', 1);
        })
            ->with('role')
            ->select('id', 'name')
            ->get();


        $problems = collect();
        foreach ($employees as $employee) {
            $employeeId = $employee->id;

            $employeeProblems = Problem::where('user_id', $employeeId)->get();

            $problems = $problems->concat($employeeProblems);
        }


        $projects = Project::where('status', '!=', 2)->where('status', '!=', 3)->latest()->get();

        if (isset($_GET['user_id'])) {
            $solutions = $solutions->where('user_id', $_GET['user_id']);
        }

        if (isset($_GET['project_id'])) {
            $solutions = $solutions->where('project_id', $_GET['project_id']);
        }


        return view('admin.user_solution.solution-list', compact('solutions', 'employees', 'projects', 'problems'));
    }





    /*
    |--------------------------------------------------------------------------
    | USER SOLUTION CREATE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function solutionCreate()
    {
        if (!has_access('create_solution')) {
            abort(404);
        }

        $employees = User::whereHas('role', function ($query) {
            $query->where('type', 1);
        })
            ->with('role')
            ->select('id', 'name')
            ->get();


        $problems = collect();
        foreach ($employees as $employee) {
            $employeeId = $employee->id;

            $employeeProblems = Problem::where('user_id', $employeeId)
                ->get();

            $problems = $problems->concat($employeeProblems);
        }


        $projects = Project::where('status', '!=', 2)
            ->where('status', '!=', 3)
            ->latest()
            ->get();


        return view('admin.user_solution.solution-form', compact('employees', 'problems', 'projects'));
    }


    /*
    |--------------------------------------------------------------------------
    | USER SOLUTION STORE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function solutionStore(Request $request)
    {
        if (!has_access('create_solution')) {
            abort(404);
        }



        $request->validate([]);

        Solution::create([
            'user_id'               => $request->employee_id,
            'project_id'            => $request->project_id,
            'user_project_id'       => $request->user_project_id,
            'user_problem_id'       => $request->user_problem_id,
            'description'           => $request->description,
        ]);
        Toastr::success('Solution Added Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return view('admin.user_solution.solution-list');
    }



    /*
    |--------------------------------------------------------------------------
    | USER SOLUTION EDIT (METHOD)
    |--------------------------------------------------------------------------
    */
    public function solutionEdit($id)
    {
        if (!has_access('edit_solution')) {
            abort(404);
        }

        $solution = Solution::find($id);
        $employees = User::whereHas('role', function ($query) {
            $query->where('type', 1);
        })
            ->with('role')
            ->select('id', 'name')
            ->get();


        $problems = collect();
        $tasks = collect();
        foreach ($employees as $employee) {
            $employeeId = $employee->id;

            $employeeProblems = Problem::where('user_id', $employeeId)
                ->get();
                $employeeTasks = UserProject::where('project_id', $solution->project_id)
                        ->where('user_id', $employeeId)
                        ->where('status','!=' ,2)
                        ->where('status','!=' ,3)
                        ->latest()
                        ->get();

            $problems = $problems->concat($employeeProblems);
            $tasks = $tasks->concat($employeeTasks);
        }



        $projects = Project::where('status', '!=', 2)
            ->where('status', '!=', 3)
            ->latest()
            ->get();


        if ($solution) {
            return view('admin.user_solution.solution-form', compact('solution', 'employees', 'problems','projects','tasks'));
        }
        return back();
    }





    /*
    |--------------------------------------------------------------------------
    | USER SOLUTION UPDATE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function solutionUpdate(Request $request, $id)
    {
        $solution = Solution::find($id);
        $request->validate([

        ]);
        if($solution)
        {
            $solution->update([
                'user_id'               => $request->employee_id,
                'project_id'            => $request->project_id,
                'user_project_id'       => $request->user_project_id,
                'user_problem_id'       => $request->user_problem_id,
                'description'           => $request->description,
            ]);
            Toastr::success('Solution updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.assignment.soluitonIndex');
        }
        return back();

    }



    /*
    |--------------------------------------------------------------------------
    | USER SOLUTION DELETE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function solutionDelete($id)
    {
    }






    /*
    |--------------------------------------------------------------------------
    | GET TASK BY USER (METHOD WITH JQUERY)
    |--------------------------------------------------------------------------
    */

    public function getTaskByUser(Request $request, $projectId)
    {
        $project = UserProject::where('user_id', $request->userId)
            ->where('project_id', $projectId)
            // ->where('status','!=' ,2)
            // ->where('status','!=' ,3)
            ->latest()
            ->with('project')
            ->get();

        return json_decode($project);
    }



    /*
    |--------------------------------------------------------------------------
    | GET PROBLEM BY USER (METHOD WITH JQUERY)
    |--------------------------------------------------------------------------
    */
    public function getProblemByUser($id)
    {
        $problems = Problem::where('user_project_id', $id)
            ->get();
        return json_decode($problems);
    }
}
