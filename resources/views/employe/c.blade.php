@extends('layouts.admin-layout')

@section('title')
    Employe List
@endsection
@section('content')
    <div class="container-fluid">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @elseif (session('delete'))
            <div class="alert alert-danger">{{ session('delete') }}</div>
        @endif

        <div class="mt-4 shadow card">
            <div class="py-3 card-header">
                <div class="form-group">
                    <label class="form-label">Choose Employee Nationility</label>
                    {{-- <select class="form-control" name="country">
                        <option selected disabled> -- Choose Nationility -- </option> --}}
                    {{-- @foreach ($empTypies as $empType)
                        <a href="{{ URL::current() . '?sort=empType/' . $empType->id }}" value="{{ $empType->id }}"
                            name="employe_type_id" class="text-dark">
                            {{ $empType->name }}

                        </a>
                    @endforeach --}}
                    <a href="{{ URL::current() . '?sort=desc' }}"> Lowest Salary </a>

                    {{-- </select> --}}
                    <form action="">
                        {{-- <div class="select-container">
            <select id="salary_range">
                <option>{{ \App\Constants\GlobalConstants::ALL }}</option>
                @foreach (\App\Models\Country::SALARY_RANGE as $range)
                    <option>{{ $range }}</option>
                @endforeach
            </select>
        </div> --}}
                        {{-- <div class="select-container">
            <select id="sort_by">
                <option>{{ \App\Constants\GlobalConstants::ALL }}</option>
                @foreach (\App\Constants\GlobalConstants::LIST_TYPE as $type)
                    <option>{{ ucfirst($type) }}</option>
                @endforeach
            </select>
        </div> --}}

                        kalid
                        <div class="row">
                            <form class="form-inline" action="{{ route('employee.index') }}" method="Get">

                                <div class="col-3">

                                    <label for="">Filter By Nationality &nbsp;</label>
                                    <select class="form-control" id="country" name="country">
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="">Joining Date</label>
                                    <?php $years = range(2010, strftime('%Y', time())); ?>
                                    <select name="join_date" class="form-control">
                                        <option>Select Year</option>
                                        <?php foreach($years as $year) : ?>
                                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-3">

                                    <label for="">Filter By Department &nbsp;</label>
                                    <select class="form-control" name="department">
                                        <option>Select Department Type</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="">Filter By Dob </label>
                                    <?php $years = range(1960, 2004); ?>
                                    <select name="dob" class="form-control">
                                        <option>Select Year</option>
                                        <?php foreach($years as $year) : ?>
                                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                                <div class="col-3">
                                    <label for="">Filter By Employe Type &nbsp;</label>
                                    <select class="form-control" name="empType">
                                        <option value="">Select Employee Type</option>
                                        @foreach ($empTypies as $empType)
                                            <option value="{{ $empType->id }}">{{ $empType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-8">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    {{-- @if (Request::query('country', 'join_date', 'empType')) --}}
                                    <a class="btn btn-success" href="{{ route('employee.index') }}">Clear</a>
                                    {{-- @endif --}}

                                </div>
                                {{-- <label for="keyword">&nbsp;&nbsp;</label>
                                <input type="text" class="form-control" name="keyword" placeholder="Enter keyword"
                                    id="keyword">
                                <span>&nbsp;</span> --}}

                            </form>
                            {{-- <select id="country_filter">
                                <option>All</option>

                            </select> --}}
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-10">
                        <h2 class=" font-weight-bold font-size-5 text-dark">Employee List</h2>

                    </div>
                    <div class="col-2">
                        <a href="{{ route('employee.create') }}" type="button" class="btn btn-lg btn-primary ">
                            Add New Employee
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                <div class="table-responsive" id='emp-data'>
                    <table class="table text-center font-weight-bold" id="dataTable" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>

                                <th scope="col">Emp Name</th>
                                <th scope="col">Department</th>
                                <th scope="col">Nationility</th>
                                <th scope="col">Employe Type</th>
                                <th scope="col">phone</th>
                                <th scope="col">Dob</th>
                                <th scope="col">joining Date</th>
                                <th scope="col">Holidy in year</th>
                                <th scope="col">Salary</th>
                                <th scope="col" class="text-center not-export">
                                    <h5>Actions</h5>
                                </th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Emp Name</th>
                                <th scope="col">Department</th>
                                <th scope="col">Nationility</th>
                                <th scope="col">Employe Type</th>
                                <th scope="col">phone</th>
                                <th scope="col">Dob</th>
                                <th scope="col">joining Date</th>
                                <th scope="col">Holidy in year</th>
                                <th scope="col">Salary</th>

                                <th scope="col">image</th>
                                <th scope="col" class="text-center not-export">Actions</th>

                            </tr>
                        </tfoot>
                        <tbody>
                            @if (request()->has('country', 'department', 'empType', 'join_date'))
                                @foreach ($employees as $employe)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td> {{ $employe->name ?? ' ' }}</td>
                                        <td>{{ $employe->department->name ?? ' ' }} </td>
                                        <td> {{ $employe->country->name ?? ' ' }} </td>
                                        <td>{{ $employe->employeType->name ?? '' }} </td>
                                        <td> {{ $employe->phone ?? '' }} </td>
                                        <td> {{ $employe->dob ?? '' }} </td>
                                        <td> {{ $employe->join_date ?? '' }} </td>
                                        <td> {{ $employe->holiday_year ?? '' }} </td>
                                        <td> {{ $employe->salaray ?? '' }} $</td>

                                        {{-- <td>
                                        {{-- <img src="/storage/roomImages/{{ $employe->image ?? ' ' }}" class="img-thumbnail" width="40" height="40" /></td> --}}
                                        {{-- <img src="{{ '/storage/productImage/' . $employe->image }}" class="img-thumbnail"
                                        width="100" height="100" /> --}}
                                        {{-- </td> --}}

                                        <td class="">
                                            <div class="d-flex ">

                                                <a href="{{ route('employee.edit', $employe->id) }}" type="button"
                                                    class="btn btn-circle btn-success "><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('employee.destroy', $employe) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="ml-2 btn btn-circle btn-danger "> <i
                                                            class="fas fa-trash "></i> </button>
                                                </form>
                                            </div>


                                        </td>
                                    </tr>
                                @endforeach
                            @elseif ($employees->count() != 0)
                                @foreach ($employees as $employe)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td> {{ $employe->name ?? ' ' }}</td>
                                        <td>{{ $employe->department->name ?? ' ' }} </td>
                                        <td> {{ $employe->country->name ?? ' ' }} </td>
                                        <td>{{ $employe->employeType->name ?? '' }} </td>
                                        <td> {{ $employe->phone ?? '' }} </td>
                                        <td> {{ $employe->dob ?? '' }} </td>
                                        <td> {{ $employe->join_date ?? '' }} </td>
                                        <td> {{ $employe->holiday_year ?? '' }} </td>
                                        <td> {{ $employe->salaray ?? '' }} $</td>

                                        {{-- <td>
                                        {{-- <img src="/storage/roomImages/{{ $employe->image ?? ' ' }}" class="img-thumbnail" width="40" height="40" /></td> --}}
                                        {{-- <img src="{{ '/storage/productImage/' . $employe->image }}" class="img-thumbnail"
                                        width="100" height="100" /> --}}
                                        {{-- </td> --}}

                                        <td class="">
                                            <div class="d-flex ">

                                                <a href="{{ route('employee.edit', $employe->id) }}" type="button"
                                                    class="btn btn-circle btn-success "><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('employee.destroy', $employe) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="ml-2 btn btn-circle btn-danger "> <i
                                                            class="fas fa-trash "></i> </button>
                                                </form>
                                            </div>


                                        </td>


                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <p>no employee founded !</p>
                                </tr>
                            @endif

                            {{-- @if ($employees->count() == 0)
                                <tr>

                                    <p>no employee founded !</p>
                                </tr>
                            @endif --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
@endsection
@section('script')
    <script>
        jQuery(document).ready(function($) {
            $('#dataTable').DataTable({
                // dom: 'Bfrtip',
                dom: "Blfrtip",

                buttons: [{
                        extend: 'pdfHtml5',
                        text: '<button  class="px-3 btn btn-primary w-100 "><i class="mr-1 fa fa-file-pdf "></i> PDF</button>',

                        title: 'All Employee List',
                        exportOptions: {
                            columns: ':visible:not(.not-export)'
                        }

                    },
                    {
                        text: '<button  class="px-3 btn btn-primary w-100 "><i class="mr-1 fa fa-copy"></i> Copy</button>',
                        extend: 'copyHtml5',
                        title: 'All Employee List',
                        exportOptions: {
                            columns: ':visible:not(.not-export)'
                        }
                    },
                    {
                        text: '<button  class="px-3 btn btn-primary w-100 "><i class="mr-1 fa fa-file-excel"></i> Excel</button>',
                        extend: 'excelHtml5',
                        title: 'All Employee List',
                        exportOptions: {
                            columns: ':visible:not(.not-export)'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<button  class="px-3 btn btn-primary w-100 "><i class="mr-1 fa fa-print"></i> Print</button>',

                        pageSize: 'A4',
                        title: 'All Employee List',
                        exportOptions: {
                            columns: ':visible:not(.not-export)'
                        }

                    },
                ]
            });

        });

        // filter data
        // $(document).ready(function () {

        // });

        $(document).ready(function() {
            // $(document).on('click', '.pagination a', function(event) {
            //   event.preventDefault();
            //   var page = $(this).attr('href').split('page=')[1];
            //   getMoreUsers(page);
            // });
            // $('#search').on('keyup', function() {
            //   $value = $(this).val();
            //   getMoreUsers(1);
            // });
            $('#country').on('change', function() {
                getMoreUsers();
            });
            // $('#sort_by').on('change', function (e) {
            // 			getMoreUsers();
            // });

            // $('#salary_range').on('change', function (e) {
            // 			getMoreUsers();
            // 		});
        });

      
    </script>
@endsection
