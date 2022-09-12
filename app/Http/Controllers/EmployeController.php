<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Department;
use App\Models\Employe;
use App\Models\EmployeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource with filtering the data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $countries = Country::get();
        $empTypies = EmployeType::get();
        $departments = Department::get();
        $query = Employe::query();

        if ($request->ajax()) {
            $country = $request->country;
            $department = $request->department;
            $empType = $request->empType;
            $join_date = $request->join_date;
            $dob = $request->dob;
            $salary = $request->salary;
            $from = $request->from;
            $to = $request->to;
            $holiday_year = $request->holiday_year;

            $employees = Employe::getFilteredEmployee($country, $department, $empType, $join_date, $dob, $salary, $from, $to, $holiday_year);

            return response()->json(['employees' => $employees]);
        }

        $employees = $query->get();

        return view('employe.index', compact('employees', 'countries', 'empTypies', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::get();
        $countries = Country::get();
        $employeTpyies = EmployeType::get();

        return view('employe.create', compact('departments', 'countries', 'employeTpyies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('/public/empImages', $fileName);
        }

        $employe = Employe::create($request->all());
        $employe->image = $fileName;
        $employe->save();

        return to_route('employee.index')->with('message', 'Employee Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employe = Employe::findOrFail($id);
        $departments = Department::get();
        $countries = Country::get();
        $employeTpyies = EmployeType::get();

        return view('employe.edit', compact('employe', 'departments', 'countries', 'employeTpyies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employe = Employe::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::delete('/public/empImages', $$employe->image);
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('/public/empImages', $fileName);
            $employe->image = $fileName;
        }

        $employe->update($request->all());

        return to_route('employee.index')->with('message', 'Employee Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employe = Employe::findOrFail($id);

        Storage::delete(['/public/empImages/'.$employe->image]);

        $employe->delete();

        return to_route('employee.index')->with('delete', 'Employee Deleted Successfully');
    }
}
