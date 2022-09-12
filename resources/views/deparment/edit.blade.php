@extends('layouts.admin-layout')

@section('content')
    <div class="p-4 ">
        <form action="{{ route('country.update', $country) }}" method="POST">
            @csrf
            @method('put')
            <div class="card border-left-primary text-dark font-weight-bold ">
                <div class=" card-header">
                    <h3 class="text-dark font-weight-bold ">Edit country</h3>
                </div>

                <div class="p-3 row ">
                    <div class="col-8 text-dark">


                        <div class="form-group ">
                            <label class="form-label">country Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $country->name }}">
                        </div>

                    </div>

                


                    <div class="m-auto form-group">

                        <button type="submit" class="mt-4 btn btn-primary">Edit Employee</button>
                        <a href="/country" type="button" class="mt-4 btn btn-danger">Go back To Employee</a>
                    </div>




                </div>
        </form>
    </div>
    </div>
@endsection
