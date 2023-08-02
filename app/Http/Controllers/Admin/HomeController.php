<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Models\Admin\Project;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            if (Auth::user()->role->type == 1){
                return redirect(RouteServiceProvider::HOME);
            }else{
                return redirect(RouteServiceProvider::ADMIN);
            }
        }else{
            return redirect()->route('login');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        //$employees = User::with('role')->where('type',1)->where('status',1)->get();
        $employees = User::leftJoin('roles', function ($join) {
                        $join->on('roles.id', '=', 'users.role_id');
                        })
                        ->where('roles.type', 1)
                        ->select('users.*', 'roles.type')
                        ->get();

        $completed_projects = Project::where('status', 2)->latest()->get();
        $running_projects = Project::where('status','!=' ,2)->where('status','!=' ,3)->latest()->get();

        // if(has_access('create_project_report')){
        //     dd('ok');
        // }

        return view('admin.index', compact('employees', 'completed_projects', 'running_projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
