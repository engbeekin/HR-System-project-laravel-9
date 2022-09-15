<?php

namespace App\Http\Controllers;


use App\Models\EmployeType;
use Illuminate\Http\Request;

class EmployeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employeeTypies = EmployeType::get();

        return view('employeetype.index', compact('employeeTypies'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employeetype.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        EmployeType::create($request->all());

        return to_route('employee_type.index')->with('message', 'Employee Type Created successfully');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeType  $employeType
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $employeType=EmployeType::findOrFail($id);
        return view('employeetype.edit', compact('employeType'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeType  $employeType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeType $employeType)
    {
        $employeType->update($request->all());

        return to_route('employee_type.index')->with('message', 'Employe Type Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeType  $employeType
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $employeType = EmployeType::findOrFail($id);

        $employeType->delete();

        return to_route('employee_type.index')->with('delete', 'Employe Type Deleted successfully');
    }
}
