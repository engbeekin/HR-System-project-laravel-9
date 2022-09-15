@extends('layouts.admin-layout')

@section('content')
    <div class="p-4 ">
        <form action="{{ route('employee_type.update', $employeType->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="card border-left-primary text-dark font-weight-bold ">
                <div class=" card-header">
                    <h3 class="text-dark font-weight-bold ">Edit Employe Type</h3>
                </div>

                <div class="p-3 row ">
                    <div class="col-8 text-dark">


                        <div class="form-group ">
                            <label class="form-label">Employe Type Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $employeType->name }}">
                        </div>

                    </div>




                    <div class="m-auto form-group">

                        <button type="submit" class="mt-4 btn btn-primary">Edit Employee Type</button>
                        <a href="/employee_type" type="button" class="mt-4 btn btn-danger">Go back To Employee Type</a>
                    </div>




                </div>
        </form>
    </div>
    </div>
@endsection
