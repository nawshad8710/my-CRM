<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Admin\Problem;
use App\Models\Admin\Project;
use App\Models\Admin\Solution;
use App\Models\Admin\UserProject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolutionController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | INDEX (METHOD)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        if (!has_access('view_solution')) {
            abort(404);
        }


        $solutions = Solution::where('user_id', Auth()->id())->latest()
            ->get();


        $employees = User::whereHas('role', function ($query) {
            $query->where('type', 1);
        })
            ->with('role')
            ->where('id',Auth()->id())
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


        return view('employee.solution.solution-list', compact('solutions', 'employees', 'projects', 'problems'));
    }





    /*
    |--------------------------------------------------------------------------
    | CREATE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $data['projects'] = UserProject::where('user_id', Auth::user()->id)
            ->where('status', '!=', 2)
            ->where('status', '!=', 3)
            ->latest()
            ->get();
        return view('employee.solution.solution-form', $data);
    }



    /*
    |--------------------------------------------------------------------------
    | STORE (METHOD)
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        //
    }




    /*
    |--------------------------------------------------------------------------
    | EDIT (METHOD)
    |--------------------------------------------------------------------------
    */

    public function edit(Solution $solution)
    {
        //
    }




    /*
    |--------------------------------------------------------------------------
    | UPDATE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Solution $solution)
    {
        //
    }





    /*
    |--------------------------------------------------------------------------
    | DELETE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function destroy(Solution $solution)
    {
        //
    }
}
