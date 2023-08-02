<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Query;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class QueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['queries'] = Query::get();
        // dd($data['sales']);
        return view('admin.query.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.query.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->is_quotation_requested || $request->is_quotation_requested == NULL){
            $request->is_quotation_requested = 0;
        }else{
            $request->is_quotation_requested = 1;
        }

        if(!$request->is_proposal_requested || $request->is_proposal_requested == NULL){
            $request->is_proposal_requested = 0;
        }else{
            $request->is_proposal_requested = 1;
        }
        
        Query::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'description' => $request->description,
                'is_quotation_requested' => $request->is_quotation_requested,
                'is_proposal_requested' => $request->is_proposal_requested,
                'user_id' => Auth()->id()
            ]
        );
        Toastr::success('Customer Query Created Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.sales.query.list');
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
        $data['query'] = Query::findOrFail($id);
        return view('admin.query.form', $data);
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
        $query = Query::findOrFail($id);
        if(!$request->is_quotation_requested || $request->is_quotation_requested == NULL){
            $request->is_quotation_requested = 0;
        }else{
            $request->is_quotation_requested = 1;
        }

        if(!$request->is_proposal_requested || $request->is_proposal_requested == NULL){
            $request->is_proposal_requested = 0;
        }else{
            $request->is_proposal_requested = 1;
        }
        
        $query->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'description' => $request->description,
                'is_quotation_requested' => $request->is_quotation_requested,
                'is_proposal_requested' => $request->is_proposal_requested,
                'user_id' => Auth()->id()
            ]
        );
        Toastr::success('Customer Query Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.sales.query.list');
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
