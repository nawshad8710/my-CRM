<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Problem;
use Illuminate\Http\Request;

use App\Models\Admin\Project;
use App\Models\User;
use App\Models\Admin\UserProject;
use Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
class AssignedProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!has_access('assigned_tasks_list_view')) {
            abort(404);
        }

        $user_projects = UserProject::latest()->get();

        if (isset($_GET['status'])) {
            $user_projects = $user_projects->where('status', $_GET['status']);
        }
        return view('admin.user_project.list', compact('user_projects'));
    }




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
        return view('admin.user_project.problem-list', compact('problems'));
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

        $employees = User::leftJoin('roles', function ($join) {
            $join->on('roles.id', '=', 'users.role_id');
        })

            ->where('roles.type', 1)
            ->select('users.*', 'roles.type')
            ->get();

        $projects = Project::where('status', '!=', 2)->where('status', '!=', 3)->latest()->get();

        return view('admin.user_project.problem-form', compact('employees', 'projects'));
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

        $imageNames = []; // Array to store the generated image names

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

                    $imageNames[] = $imageName; // Store the generated image name in the array
                }
            }
        }




        if (!$request->status || $request->status == NULL) {
            $request->status = 0;
        }

        Problem::create([
            'user_id'                   => $request->user_id,
            'project_id'                => $request->project_id,
            'title'                     => $request->title,
            'description'               => $request->description,
            'date'                      => $request->date,
            'images'                  =>  serialize($imageNames),
            'status'                    => $request->status,
        ]);

        Toastr::success('Problem Added Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.assignment.problemIndex');
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT PROBLEM (METHOD)
    |--------------------------------------------------------------------------
    */

    public function editProblem($id)
    {
        if (!has_access('update_problem')) {
            abort(404);
        }

        $problem = Problem::findOrFail($id);
        $imageNames = unserialize($problem->images);

        //$employees = User::where('role',1)->where('status',1)->get();
        $employees = User::leftJoin('roles', function ($join) {
            $join->on('roles.id', '=', 'users.role_id');
        })

            ->where('roles.type', 1)
            ->select('users.*', 'roles.type')
            ->get();

        $projects = Project::where('status', '!=', 2)->where('status', '!=', 3)->latest()->get();

        if ($problem) {
            return view('admin.user_project.problem-form', compact('problem','imageNames', 'employees', 'projects'));
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
        $request->validate([
            // 'user_id' => 'required',
            // 'project_id' => 'required',
            // 'title' => 'required|string|max:100',
            // 'task' => 'required',
            // 'deadline' => 'required',
        ]);

        $problems = Problem::findOrFail($id);

        $existingImages = unserialize($problems->images);
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
            $imagePath = public_path('assets/images/uploads/problems') . '/' . $imageName;
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        if ($problems) {
            if (!$request->status || $request->status == NULL) {
                $request->status = 0;
            }

            $problems->update([
                'user_id'                   => $request->user_id,
                'project_id'                => $request->project_id,
                'title'                     => $request->title,
                'description'               => $request->description,
                'date'                      => $request->date,
                'images'                    => serialize($newImages),
                'status'                    => $request->status,
            ]);

            Toastr::success('Problem Info Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);

            return redirect()->route('admin.assignment.problemIndex');
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









    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!has_access('assign_task_to_employee')) {
            abort(404);
        }
        //$employees = User::where('role',1)->where('status',1)->get();
        $employees = User::leftJoin('roles', function ($join) {
            $join->on('roles.id', '=', 'users.role_id');
        })
            ->where('roles.type', 1)
            ->select('users.*', 'roles.type')
            ->get();
        $projects = Project::where('status', '!=', 2)->where('status', '!=', 3)->latest()->get();

        return view('admin.user_project.form', compact('employees', 'projects'));
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
            'title' => 'required|string|max:100',
            'task' => 'required',
            'deadline' => 'required',
        ]);

        if (!$request->status || $request->status == NULL) {
            $request->status = 0;
        }

        UserProject::create([
            'user_id' => $request->user_id,
            'project_id' => $request->project_id,
            'title' => $request->title,
            'task' => $request->task,
            'deadline' => $request->deadline,
            'status' => $request->status,
        ]);

        Toastr::success('Assignment Added Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.assignment.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getListByProject($id)
    {
        $assignments = UserProject::where('project_id', $id)->latest()->get();

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
        if (!has_access('update_assigned_task')) {
            abort(404);
        }
        $assignment = UserProject::findOrFail($id);
        //$employees = User::where('role',1)->where('status',1)->get();
        $employees = User::leftJoin('roles', function ($join) {
            $join->on('roles.id', '=', 'users.role_id');
        })
            ->where('roles.type', 1)
            ->select('users.*', 'roles.type')
            ->get();
        $projects = Project::where('status', '!=', 2)->where('status', '!=', 3)->latest()->get();

        if ($assignment) {
            return view('admin.user_project.form', compact('assignment', 'employees', 'projects'));
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
            'title' => 'required|string|max:100',
            'task' => 'required',
            'deadline' => 'required',
        ]);

        $assignment = UserProject::findOrFail($id);

        if ($assignment) {
            if (!$request->status || $request->status == NULL) {
                $request->status = 0;
            }

            $assignment->update([
                'user_id' => $request->user_id,
                'project_id' => $request->project_id,
                'title' => $request->title,
                'task' => $request->task,
                'deadline' => $request->deadline,
                'status' => $request->status,
            ]);

            Toastr::success('Assignment Info Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);

            return redirect()->route('admin.assignment.list');
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
        if (!has_access('delete_assigned_task')) {
            abort(404);
        }
        $assignment = UserProject::findOrFail($id);
        if ($assignment) {
            $assignment->delete();
            Toastr::success('Assignment Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        }
        return 1;
    }
}
