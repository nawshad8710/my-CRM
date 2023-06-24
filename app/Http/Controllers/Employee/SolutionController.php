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
        $problemId = Problem::query()
        ->where('user_id', auth()->id())
        ->pluck('id');
        $solutions = Solution::whereIn('user_problem_id', $problemId)
        ->with('problem', 'problem.project', 'problem.user_project')
        ->get();


        return view('employee.solution.solution-list', compact('solutions'));
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
