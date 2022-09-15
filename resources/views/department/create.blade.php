@extends('layouts.admin-layout')

@section('content')
    <div class="p-4 ">
        <form action="{{ route('department.store') }}" method="POST">
            @csrf
            <div class="card border-left-primary text-dark font-weight-bold ">
                <div class=" card-header">
                    <h3 class="text-dark font-weight-bold ">Add New Department</h3>
                </div>

                <div class="p-3 ">
                    <div class="text-dark">


                        <div class="form-group ">
                            <label class="form-label">Department Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>




                    <div class="m-auto form-group">

                        <button type="submit" class="mt-4 btn btn-primary">Add New Department</button>
                        <a href="/department" type="button" class="mt-4 btn btn-danger">Go back To Department</a>
                    </div>




                </div>
        </form>
    </div>
    </div>
@endsection
