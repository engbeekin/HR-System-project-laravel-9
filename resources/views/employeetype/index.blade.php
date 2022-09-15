@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @elseif (session('delete'))
            <div class="alert alert-danger">{{ session('delete') }}</div>
        @endif

        <div class="mt-4 shadow card">
            <div class="py-3 card-header">
                <div class="row">
                    <div class="col-10">
                        <h2 class=" font-weight-bold font-size-5 text-dark">Employe Type List</h2>

                    </div>
                    <div class="col-2">
                        <a href="{{ route('employee_type.create') }}" type="button" class="btn btn-lg btn-primary ">
                            Add New Employe Type
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                <div class="table-responsive">
                    <table class="table text-center font-weight-bold" id="dataTable" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">
                                    <h5>employe Type Name</h5>
                                </th>


                                <th  class="not-export">
                                    <h5>Actions</h5>
                                </th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">employe Type Name</th>

                                <th scope="col" class=" not-export">Actions</th>

                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($employeeTypies as $employeType)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td> {{ $employeType->name ?? ' ' }}</td>



                                    <td class="">
                                        <div class="ml-5 d-flex">

                                            <a href="{{ route('employee_type.edit', $employeType) }}" type="button"
                                                class="btn btn-circle btn-success"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('employee_type.destroy', $employeType->id) }}" method="post">
                                                @csrf
                                                @method('Delete')
                                                <button type="submit" class="btn btn-circle btn-danger"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </div>

                                    </td>


                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
@endsection
