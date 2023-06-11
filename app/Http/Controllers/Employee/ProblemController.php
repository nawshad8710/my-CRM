<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


use App\Models\Admin\Problem;


use App\Models\Admin\Project;
use App\Models\User;
use App\Models\Admin\UserProject;
use Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProblemController extends Controller
{

    /*-----------------start problems----------------------*/
    /*
    |--------------------------------------------------------------------------
    | PROBLEM INDEX (METHOD)
    |--------------------------------------------------------------------------
    */

    public function problemIndex()
    {
        if (!has_access('employee_problem_list')) {
            abort(404);
        }
        $problems = Problem::latest()->get();
        

        if (isset($_GET['status'])) {
            $problems = $problems->where('status', $_GET['status']);
        }
        return view('employee.problem.problem-list', compact('problems'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE PROBLEM (METHOD)
    |--------------------------------------------------------------------------
    */

    public function addProblem()
    {
        if (!has_access('create_problem')) {
            abort(404);
        }

        // dd(Auth::user()->id);
        $projects = UserProject::where('user_id', Auth::user()->id)
            ->where('status', '!=', 2)
            ->where('status', '!=', 3)->latest()->get();

        // dd($projects);
        return view('employee.problem.problem-form', compact('projects'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE PROBLEM (METHOD)
    |--------------------------------------------------------------------------
    */

    public function problemStore(Request $request)
    {
        // dd($request->all());

        if (!has_access('create_problem')) {
            abort(404);
        }

        $request->validate([
            // 'user_id' => 'required',
            // 'project_id' => 'required',
            // 'title' => 'required|string|max:100',
            // 'task' => 'required',
            // 'deadline' => 'required',
        ]);

        $imageNames = [];

        $images = $request->file('images');

        if ($images && is_array($images)) {
            foreach ($images as $image) {
                if ($image && $image->isValid()) {
                    $currentDate = Carbon::now()->toDateString();
                    $originalName = $image->getClientOriginalName();
                    $sanitizedFileName = pathinfo($originalName, PATHINFO_FILENAME);
                    $imageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

                    if (!is_dir('assets/images/uploads/problems')) {
                        mkdir('assets/images/uploads/problems', 0777, true);
                    }

                    $image->move(public_path('assets/images/uploads/problems'), $imageName);

                    $imageNames[] = $imageName;
                }
            }
        }




        // if (!$request->status || $request->status == NULL) {
        //     $request->status = 0;
        // }

        Problem::create([
            'user_id'                   => Auth::user()->id,
            'project_id'                => $request->project_id,
            'user_project_id'           => $request->user_project_id,
            'title'                     => $request->title,
            'description'               => $request->description,
            // 'date'                      => $request->date,
            'images'                    =>  serialize($imageNames),
            // 'status'                    => $request->status,
        ]);

        Toastr::success('Problem Added Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('employee.problem.problemIndex');
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT PROBLEM (METHOD)
    |--------------------------------------------------------------------------
    */

    public function editProblem($id)
    {

        // if (!has_access('update_problem')) {
        //     abort(404);
        // }

        $problem = Problem::findOrFail($id);
        $projects = UserProject::where('user_id', Auth::user()->id)->where('status', '!=', 2)->where('status', '!=', 3)->latest()->get();



        if ($problem) {
            $tasks = UserProject::where('project_id', $problem->project_id)->where('user_id', Auth::user()->id)->where('status', '!=', 2)->where('status', '!=', 3)->latest()->get();
            $imageNames = unserialize($problem->images);

            return view('employee.problem.problem-form', compact('problem', 'imageNames', 'projects', 'tasks'));
        }
        return back();
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PROBLEM (METHOD)
    |--------------------------------------------------------------------------
    */

    public function updateProblem(Request $request, $id)
    {
        // dd($request->all());

        $request->validate([
            // 'user_id' => 'required',
            // 'project_id' => 'required',
            // 'title' => 'required|string|max:100',
            // 'task' => 'required',
            // 'deadline' => 'required',
        ]);

        $problems = Problem::findOrFail($id);

        $existingImages = unserialize($problems->images);





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

                        if (!is_dir('assets/images/uploads/problems')) {
                            mkdir('assets/images/uploads/problems', 0777, true);
                        }

                        $image->move(public_path('assets/images/uploads/problems'), $imageName);

                        $newImages[] = $imageName;
                    }
                }
            }

            $imagesToDelete = array_diff($existingImages, $newImages);
            foreach ($imagesToDelete as $imageName) {
                if (!in_array($imageName, $newImages)) {
                    $imagePath = public_path('assets/images/uploads/problems') . '/' . $imageName;
                    if (File::exists($imagePath)) {
                        File::delete($imagePath);
                    }
                }
            }
        }


        $updatedImages = !empty($newImages) ? $newImages : $existingImages;

        if ($problems) {
            if (!$request->status || $request->status == NULL) {
                $request->status = 0;
            }

            $problems->update([
                'user_id'                   => Auth::user()->id,
                'project_id'                => $request->project_id,
                'user_project_id'           => $request->user_project_id,
                'title'                     => $request->title,
                'description'               => $request->description,
                // 'date'                      => $request->date,
                'images'                    =>  serialize($updatedImages),
                // 'status'                    => $request->status,
            ]);

            Toastr::success('Problem Info Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);

            return redirect()->route('employee.problem.problemIndex');
        }
        return back();
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE PROBLEM (METHOD)
    |--------------------------------------------------------------------------
    */
    public function deleteProblem($id)
    { {
            if (!has_access('delete_problem')) {
                abort(404);
            }


            $problems = Problem::findOrFail($id);

            if ($problems) {
                $imageNames = unserialize($problems->images);

                foreach ($imageNames as $imageName) {
                    $imagePath = public_path('assets/images/uploads/problems') . '/' . $imageName;
                    if (File::exists($imagePath)) {
                        File::delete($imagePath);
                    }
                }
                $problems->delete();
                Toastr::success('Problems Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            }
            return 1;
        }
    }
    /*-----------------end of problems----------------------*/
}
