<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Problem;
use App\Models\Admin\Project;
use App\Models\Admin\Solution;
use App\Models\Admin\UserProject;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use File;
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


        $solutions = Solution::query()
        ->with('problem','problem.user','problem.project', 'problem.user_project')
        ->get();

        return view('admin.user_solution.solution-list', compact('solutions'));
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

        $problems = Problem::get();

        return view('admin.user_solution.solution-form', compact('problems'));
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
        $imageNames = [];

        $images = $request->file('images');

        if ($images && is_array($images)) {
            foreach ($images as $image) {
                if ($image && $image->isValid()) {
                    $currentDate = Carbon::now()->toDateString();
                    $originalName = $image->getClientOriginalName();
                    $sanitizedFileName = pathinfo($originalName, PATHINFO_FILENAME);
                    $imageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

                    if (!is_dir('assets/images/uploads/solution')) {
                        mkdir('assets/images/uploads/solution', 0777, true);
                    }

                    $image->move(public_path('assets/images/uploads/solution'), $imageName);

                    $imageNames[] = $imageName;
                }
            }
        }

        $solution = Solution::where('user_problem_id', $request->user_problem_id)->first();
        if($solution)
        {
            Toastr::warning('Solution Already Added For This Problem!', 'Warning', ["positionClass" => "toast-top-right"]);
            return back();
        }else{
            Solution::create([
                'user_problem_id'       => $request->user_problem_id,
                'description'           => $request->description,
                'images'                => serialize($imageNames),
            ]);
            Toastr::success('Solution Added Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.assignment.soluitonIndex');
        }
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
                ->where('status', '!=', 2)
                ->where('status', '!=', 3)
                ->latest()
                ->get();

            $problems = $problems->concat($employeeProblems);
            // dd($problems);
            $tasks = $tasks->concat($employeeTasks);
        }



        $projects = Project::where('status', '!=', 2)
            ->where('status', '!=', 3)
            ->latest()
            ->get();


        if ($solution) {
            $imageNames = unserialize($solution->images);
            return view('admin.user_solution.solution-form', compact('solution', 'employees', 'problems', 'projects', 'tasks', 'imageNames'));
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
        $request->validate([]);
        $existingImages = unserialize($solution->images);
        if ($request->file('images')) {
            $newImages = [];
            $images = $request->file('images');
            if ($images && is_array($images)) {
                foreach ($images as $image) {

                    if ($image && $image->isValid()) {
                        $currentDate = Carbon::now()->toDateString();
                        $originalName = $image->getClientOriginalName();
                        $sanitizedFileName = pathinfo($originalName, PATHINFO_FILENAME);
                        $imageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

                        if (!is_dir('assets/images/uploads/solution')) {
                            mkdir('assets/images/uploads/solution', 0777, true);
                        }

                        $image->move(public_path('assets/images/uploads/solution'), $imageName);

                        $newImages[] = $imageName;
                    }
                }
            }

            $imagesToDelete = array_diff($existingImages, $newImages);
            foreach ($imagesToDelete as $imageName) {
                if (!in_array($imageName, $newImages)) {
                    $imagePath = public_path('assets/images/uploads/solution') . '/' . $imageName;
                    if (File::exists($imagePath)) {
                        File::delete($imagePath);
                    }
                }
            }
        }


        $updatedImages = !empty($newImages) ? $newImages : $existingImages;

        if ($solution) {
            $solution->update([
                'user_id'               => $request->employee_id,
                'project_id'            => $request->project_id,
                'user_project_id'       => $request->user_project_id,
                'user_problem_id'       => $request->user_problem_id,
                'description'           => $request->description,
                'images'                =>  serialize($updatedImages),
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
        if (!has_access('delete_solution')) {
            abort(404);
        }


        $soltuion = Solution::findOrFail($id);

        if ($soltuion->images == !null) {
            $imageNames = unserialize($soltuion->images);

            foreach ($imageNames as $imageName) {
                $imagePath = public_path('assets/images/uploads/solution') . '/' . $imageName;
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
            $soltuion->delete();
            Toastr::success('solution Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        }
        $soltuion->delete();
        Toastr::success('solution Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return 1;
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
