@extends('layouts.admin-layout')

@section('content')
    <div class="p-4 ">
        <form action="{{route('employee.update',$employe->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card border-left-primary text-dark font-weight-bold ">
                <div class=" card-header">
                    <h3 class="text-dark font-weight-bold ">Add New Employee</h3>
                </div>

                <div class="p-3 row ">
                    <div class="col-6 text-dark">


                        <div class="form-group ">
                            <label class="form-label">Employe Name</label>
                            <input type="text" class="form-control" name="name" value="{{$employe->name}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Choose Employee Nationility</label>
                            <select class="form-control" name="country_id">
                                <option selected disabled> -- Choose Nationility -- </option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" class="text-dark"> {{ $country->name }}
                                    </option>
                                @endforeach

                            </select ct>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" value="{{$employe->address}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="dob" value="{{$employe->dob}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Employe Photo</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <img src="{{ '/storage/empImages/' . $employe->image }}" class="img-thumbnail" height="200px"
                            width="200px" alt="image">
                        
                    </div>

                    <div class="col-6">

                        <div class="form-group">
                            <label class="form-label">Choose Department</label>
                            <select class="form-control" name="department_id">
                                <option selected disabled> -- Choose Department -- </option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" class="text-dark"> {{ $department->name }}
                                    </option>
                                @endforeach

                            </select ct>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Choose Employe Type</label>
                            <select class="form-control" name="employe_type_id">
                                <option selected disabled> -- Choose Employe Type -- </option>
                                @foreach ($employeTpyies as $employeType)
                                    <option value="{{ $employeType->id }}" class="text-dark"> {{ $employeType->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{$employe->dob}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Employe joining Date</label>
                            <input type="date" class="form-control" name="join_date" value="{{$employe->dob}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Salary</label>
                            <input type="text" class="form-control" name="salaray" value="{{$employe->salaray}}">
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="mt-2 form-label">Employe Holiday in the year</label>
                            <input type="date" class="form-control" name="holiday_year" value="{{$employe->dob}}">
                        </div>
                    </div>



                    <div class="m-auto form-group col-12 offset-3">

                        <button type="submit" class="mt-4 btn btn-primary">Edit  Employe</button>
                        <a href="/employee" type="button" class="mt-4 btn btn-danger">Go back To Employe</a>
                    </div>




                </div>
        </form>
    </div>
    </div>
@endsection
