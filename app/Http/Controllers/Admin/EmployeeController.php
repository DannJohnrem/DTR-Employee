<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Model\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all()->where('is_delete', 0);;
        // dd($employees);
        return view('admin.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        Employee::create($request->validated());
        return redirect()->route('employees.index')->with('success-message', 'New document added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return $employee;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('admin.index', ['employee'=>$employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());
        return back()->with('success-message', 'Employee Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {

        // if ($employee->trashed()) {
        //     $employee = Employee::withTrashed()
        //         ->where('is_delete', 0)
        //         ->get();
        // }
        
        // $employee = Employee::onlyTrashed()->find($id);

        // if (!is_null($employee)) {

        //     $employee ->restore();
        //     $response = $this->successfulMessage(200, 'Successfully restored', true, $employee ->count(), $employee);
        // } else {

        //     return response($response);
        // }
        // return response($response);

        // $employee->update($request->validated());
        // return back()->with('success-message', 'restored');

        // Employee::onlyTrashed()->where('is_delete', 1)->restore();
        // return redirect()->route('employees.index')->with('success-message', 'restored file'); 
            
        if ($employee->delete()) {
            return back()->with('undo-message', 'Data deleted!');
        }

        return back()->with('error-message', 'Failed to remove data!');
        
    }

    public function restore(Employee $employee)
    {
        if ($employee->trashed()) {
            $employee = Employee::withTrashed()
                ->where('is_delete', 0)
                ->get();

            return redirect()->route('admin.index')->with('undo-message', 'Undo seccessfully'); 
        }
        
    }
}

