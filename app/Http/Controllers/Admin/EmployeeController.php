<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\Role;
use Illuminate\Support\Facades\Hash;
use Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\MenuHead;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu_roles = DB::table('menu_role')
            ->where('role_id',  Auth::user()->role->id)
            ->where('menu_head_key', 'c_sales')
            ->where('status', 1)
            ->get();
        $menuHead = MenuHead::where('key', 'c_sales')->first();
        // dd($menuHead);
        if(!has_access('employee_list_view')){
            abort(404);
        }
        //$employees = User::with('roles')->where('type',1)->get();
        $employees = User::leftJoin('roles', function ($join) {
                    $join->on('roles.id', '=', 'users.role_id');
                    })
                    ->where('roles.type', 1)
                    ->select('users.*', 'roles.type')
                    ->get();

        //dd($employees);

        if(isset($_GET['status'])){
            $employees = $employees->where('status', $_GET['status']);
        }
        return view('admin.employee.list', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!has_access('create_employee')){
            abort(404);
        }
        $roles = Role::where('status', 1)->get();
        return view('admin.employee.form', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users|max:150',
            'email' => 'required|unique:users|max:150',
            'phone' => 'required|unique:users|max:50',
            'designation' => 'required|max:100',
            'salary' => 'required|numeric',
            'address' => 'nullable',
        ]);

        if(!$request->status || $request->status == NULL){
            $request->status = 0;
        }else{
            $request->status = 1;
        }

        $request->password = "12345678";

        $imageName = '';
        $image = $request->file('photo');
        if($image) {
            $currentDate = Carbon::now()->toDateString();
            $imageName   = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            

            if (!file_exists('assets/images/uploads/users')) {
                mkdir('assets/images/uploads/users', 0777, true);
            }
            $image->move(public_path('assets/images/uploads/users'), $imageName);
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make("12345678"),
            'designation' => $request->designation,
            'salary' => $request->salary,
            'address' => $request->address,
            'photo' => $imageName,
            'role_id' => 1,
            'status' => $request->status,
        ]);

        Toastr::success('Employee Added Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.employee.list');
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
        if(!has_access('update_employee')){
            abort(404);
        }
        $employee = User::findOrFail($id);
        if($employee){
            $roles = Role::where('status', 1)->get();
            return view('admin.employee.form', compact('employee', 'roles'));
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
        $user = User::findOrFail($id);

        if($user){
            $validated = $request->validate([
                'name' => 'required|max:255',
                'username' => 'required|max:150',
                'email' => 'required|max:150',
                'phone' => 'required|max:50',
                'designation' => 'required|max:100',
                'salary' => 'required|numeric',
                'address' => 'nullable',
                'role_id' => 'required',
            ]);

            if(!$request->status || $request->status == NULL){
                $request->status = 0;
            }else{
                $request->status = 1;
            }

            $imageName = $user->photo;
            $image = $request->file('photo');
            ///dd($image);
            if($image){
                $currentDate = Carbon::now()->toDateString();
                $imageName   = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                

                if (!file_exists('assets/images/uploads/users')) {
                    mkdir('assets/images/uploads/users', 0777, true);
                }
                $image->move(public_path('assets/images/uploads/users'), $imageName);
                //$image->move(base_path().'/assets/images/uploads/users', $imageName);
            }

            //dd($imageName);

            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'designation' => $request->designation,
                'salary' => $request->salary,
                'address' => $request->address,
                'photo' => $imageName,
                'role_id' => $request->role_id,
                'status' => $request->status,
            ]);

            Toastr::success('Employee Info Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        }

        return redirect()->route('admin.employee.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!has_access('delete_employee')){
            abort(404);
        }
        $user = User::findOrFail($id);
        if($user){
            $user->delete();
            Toastr::success('Employee Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        }
        return 1;
    }
}
