<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Facades\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Employee::all();
        return view('index', compact('data'));
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
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
        }
        $emp = new Employee;
        $emp->name = $request->input('name');
        $emp->email = $request->input('email');
        $emp->address = $request->input('address');
        $emp->phone = $request->input('phone');
        $emp->image = $imageName;
        $emp->save();

        // Employee::create(
        //     Request::validate([
        //     'name' => ['required'],
        //     'email' => ['required'],
        //     'address' => ['required'],
        //     'phone' => ['required'],
        //     ])
        // );
        return Redirect::route('index_view');
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
        $emp = Employee::find($id);
        return response()->json([
            'status' => 'success',
            'emp' => $emp
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
        }
        $emp_id = $request->input('emp_id');
        $emp = Employee::find($emp_id);
        $emp->name = $request->input('name');
        $emp->email = $request->input('email');
        $emp->address = $request->input('address');
        $emp->phone = $request->input('phone');
        $emp->image = $imageName;
        $emp->save();

        return Redirect::route('index_view');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $emp = Employee::find($id);
        $emp->delete();
        return Redirect::route('index_view');
    }


}
