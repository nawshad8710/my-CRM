<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Branch;
use App\Models\Admin\Role;
use Illuminate\Support\Facades\Hash;
use Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\MenuHead;

class BranchController extends Controller
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
        $branches = Branch::where('status', 1)
                    ->get();

        //dd($employees);

        // if(isset($_GET['status'])){
        //     $employees = $employees->where('status', $_GET['status']);
        // }
        return view('admin.branch.list', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!has_access('create_branch')){
            abort(404);
        }
        return view('admin.branch.form');
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
            'name' => 'required|max:255',
            'email' => 'nullable|unique:users|max:150',
            'phone' => 'nullable|unique:users|max:50',
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

        Branch::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'photo' => $imageName,
            'status' => $request->status,
        ]);

        Toastr::success('branch Added Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.branch.list');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
