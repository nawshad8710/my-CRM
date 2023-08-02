<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Role;
use App\Models\Admin\Menu;
use App\Models\Admin\MenuHead;
use App\Models\Admin\MenuRole;
use App\Models\User;
use Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!has_access('role_list_view')){
            abort(404);
        }

        $roles = Role::latest()->get();
        if(isset($_GET['status'])){
            $roles = $roles->where('status', $_GET['status']);
        }
        return view('admin.role.list', compact('roles'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userList()
    {
        if(!has_access('user_list_view')){
            abort(404);
        }

        $users = User::leftJoin('roles', function ($join) {
                    $join->on('roles.id', '=', 'users.role_id');
                    })
                    ->where('roles.type', 2)
                    ->select('users.*', 'roles.type')
                    ->get();

        //dd($users);

        if(isset($_GET['status'])){
            $users = $users->where('status', $_GET['status']);
        }
        return view('admin.role.list_user', compact('users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function menuHeadList()
    {
        if(!has_access('menu_head_list_view')){
            abort(404);
        }

        $menu_heads = MenuHead::latest()->get();

        //dd($users);

        if(isset($_GET['status'])){
            $menu_heads = $menu_heads->where('status', $_GET['status']);
        }
        return view('admin.role.list_menu_head', compact('menu_heads'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function menuList()
    {
        if(!has_access('menu_list_view')){
            abort(404);
        }
        $menus = Menu::leftJoin('menu_heads', function ($join) {
                    $join->on('menu_heads.id', '=', 'menus.menu_head_id');
                    })
                    ->where('menu_heads.status', 1)
                    ->select('menus.*', 'menu_heads.title as menu_head_title')
                    ->get();

        //dd($users);

        if(isset($_GET['status'])){
            $menus = $menus->where('status', $_GET['status']);
        }

        $menu_heads = MenuHead::where('status', 1)->get();

        return view('admin.role.list_menu', compact('menus', 'menu_heads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!has_access('create_role')){
            abort(404);
        }
        return view('admin.role.form');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser()
    {
        if(!has_access('create_user')){
            abort(404);
        }
        $roles = Role::where('status', 1)->get();
        return view('admin.role.form_user', compact('roles'));
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
            'name' => 'required|max:100',
            'type' => 'required',
            'status' => 'nullable',
        ]);

        if(!$request->status || $request->status == NULL){
            $request->status = 0;
        }else{
            $request->status = 1;
        }

        Role::create([
            'name' => $request->name,
            'type' => $request->type,
            'status' => $request->status,
        ]);

        Toastr::success('Role Added Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.role.list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function userStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users|max:150',
            'email' => 'required|unique:users|max:150',
            'phone' => 'required|unique:users|max:50',
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
            'role_id' => $request->role_id,
            'status' => $request->status,
        ]);

        Toastr::success('User Added Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.role.userList');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function menuHeadStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:100',
        ]);

        $key = strtolower(str_replace(' ', '_', $request->title));

        MenuHead::create([
            'title' => $request->title,
            'key' => $key,
        ]);

        Toastr::success('New Menu Head Created Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function menuStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:100',
        ]);

        $key = strtolower(str_replace(' ', '_', $request->title));

        if($request->menu_head_id && $request->menu_head_id > 0){
            Menu::create([
                'title' => $request->title,
                'key' => $key,
                'menu_head_id' => $request->menu_head_id,
            ]);

            Toastr::success('New Menu Created Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return back();
        }

        Toastr::error('Select a menu head first!', 'Failed', ["positionClass" => "toast-top-right"]);
        return back();
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
        if(!has_access('update_role')){
            abort(404);
        }

        $role = Role::findOrFail($id);
        if($role){
            return view('admin.role.form', compact('role'));
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editRoleAccess($id)
    {
        if(!has_access('role_wise_menu_permission_update')){
            abort(404);
        }

        $role = Role::findOrFail($id);
        $menu_heads = MenuHead::where('status', 1)->get();
        foreach($menu_heads as $menu_head){
            $menus = Menu::where('menu_head_id', $menu_head->id)->where('status', 1)->get();
            $menu_head->menus = $menus;
        }
        //dd($menu_heads);

        $menu_roles = MenuRole::where('role_id', $role->id)->where('status', 1)->get();
        $menu_roles = DB::table('menu_role')
            ->where('role_id', $role->id)
            ->where('status', 1)
            ->select('menu_key')
            ->get();
        
        //dd($menu_roles);

        $role_menus = array();
        foreach($menu_roles as $menu_role){
            array_push($role_menus, $menu_role->menu_key);
        }

        //dd($role_menus);

        if($role){
            return view('admin.role.form_role_access', compact('role', 'menu_heads', 'role_menus'));
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userEdit($id)
    {
        if(!has_access('update_user')){
            abort(404);
        }

        $user = User::findOrFail($id);
        if($user){
            $roles = Role::where('status', 1)->get();
            return view('admin.role.form_user', compact('user', 'roles'));
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function menuHeadEdit($id)
    {
        if(!has_access('update_menu_head')){
            abort(404);
        }
        
        $menu_head = MenuHead::findOrFail($id);
        if($menu_head){
            return view('admin.role.form_menu_head', compact('menu_head'));
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function menuEdit($id)
    {
        if(!has_access('update_menu')){
            abort(404);
        }
        
        $menu = Menu::findOrFail($id);
        if($menu){
            $menu_heads = MenuHead::where('status', 1)->get();
            return view('admin.role.form_menu', compact('menu', 'menu_heads'));
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
        $role = Role::findOrFail($id);

        if($role){
            $validated = $request->validate([
                'name' => 'required|max:100',
                'type' => 'required',
                'status' => 'nullable',
            ]);

            if(!$request->status || $request->status == NULL){
                $request->status = 0;
            }else{
                $request->status = 1;
            }

            $role->update([
                'name' => $request->name,
                'type' => $request->type,
                'status' => $request->status,
            ]);

            Toastr::success('User Role Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        }

        return redirect()->route('admin.role.list');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userUpdate(Request $request, $id)
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
            if($image){
                $currentDate = Carbon::now()->toDateString();
                $imageName   = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                

                if (!file_exists('assets/images/uploads/users')) {
                    mkdir('assets/images/uploads/users', 0777, true);
                }
                //$image->move(public_path('assets/images/uploads/users'), $imageName);
                $image->move(base_path().'/assets/images/uploads/users', $imageName);
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

            Toastr::success('User Info Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        }

        return redirect()->route('admin.role.userList');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function menuHeadUpdate(Request $request, $id)
    {
        $menu_head = MenuHead::findOrFail($id);

        if($menu_head){
            $validated = $request->validate([
                'title' => 'required|max:100',
            ]);

            if(!$request->status || $request->status == NULL){
                $request->status = 0;
            }else{
                $request->status = 1;
            }

            $menu_head->update([
                'title' => $request->title,
                'status' => $request->status,
            ]);

            Toastr::success('Menu Head Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        }

        return redirect()->route('admin.role.menuHeadList');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function menuUpdate(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        if($menu){
            $validated = $request->validate([
                'title' => 'required|max:100',
                'menu_head_id' => 'required',
            ]);

            if(!$request->status || $request->status == NULL){
                $request->status = 0;
            }else{
                $request->status = 1;
            }

            $menu->update([
                'title' => $request->title,
                'menu_head_id' => $request->menu_head_id,
                'status' => $request->status,
            ]);

            Toastr::success('Menu Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        }

        return redirect()->route('admin.role.menuList');
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRoleAccess(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        //dd(count($request->menu_status));

        if($role){

            DB::table('menu_role')
            ->where('role_id', $role->id)
            ->where('status', 1)
            ->delete();

            for($i=0; $i<count($request->menu_status); $i++){
                if($request->menu_status[$i]==1){
                    MenuRole::create([
                        'role_id' => $role->id,
                        'menu_id' => $request->menu_id[$i],
                        'menu_key' => $request->menu_key[$i],
                        'menu_head_key' => $request->menu_head_key[$i],
                    ]);
                }
            }

            Toastr::success('Role Permissions Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
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
        if(!has_access('delete_role')){
            abort(404);
        }
        
        $role = Role::findOrFail($id);
        if($role){
            $role->delete();
            Toastr::success('Role Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        }
        return 1;
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userDestroy($id)
    {
        if(!has_access('delete_user')){
            abort(404);
        }
        
        $user = User::findOrFail($id);
        if($user){
            $user->delete();
            Toastr::success('User Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        }
        return 1;
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function menuHeadDestroy($id)
    {
        if(!has_access('delete_menu_head')){
            abort(404);
        }
        
        $menu_head = MenuHead::findOrFail($id);
        if($menu_head){
            $menu_head->delete();
            Toastr::success('Menu Head Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        }
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function menuDestroy($id)
    {
        if(!has_access('delete_menu')){
            abort(404);
        }
        
        $menu = Menu::findOrFail($id);
        if($menu){
            $menu->delete();
            Toastr::success('Menu Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        }
        return 1;
    }
}
