@extends('layouts.admin-layout')

@section('content')
    <div class="p-4 ">
        <form action="{{ route('country.store') }}" method="POST">
            @csrf
            <div class="card border-left-primary text-dark font-weight-bold ">
                <div class=" card-header">
                    <h3 class="text-dark font-weight-bold ">Add New Country</h3>
                </div>

                <div class="p-3 ">
                    <div class="text-dark">


                        <div class="form-group ">
                            <label class="form-label">Country Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>

                   


                    <div class="m-auto form-group">

                        <button type="submit" class="mt-4 btn btn-primary">Add New Country</button>
                        <a href="/country" type="button" class="mt-4 btn btn-danger">Go back To Country</a>
                    </div>




                </div>
        </form>
    </div>
    </div>
@endsection
