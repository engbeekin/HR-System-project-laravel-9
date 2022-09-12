@extends('layouts.admin-layout')

@section('title')
    Employe List
@endsection
@section('content')
    <div class="container-fluid" style="color: black">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @elseif (session('delete'))
            <div class="alert alert-danger">{{ session('delete') }}</div>
        @endif

        <div class="mt-4 shadow card">
            <div class="py-3 card-header">



                <div class="form-group">

                    <form action="">
                        <div class="row " style="color: black">
                            <form class="form-inline" action="" method="Get">

                                <div class="col-4" style="color: black">

                                    <label for="">Filter By Nationality &nbsp;</label>
                                    <select class="form-control" id="country_filter" name="country" style="color: black">
                                        <option value="">All</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="">Joining Date</label>
                                    <?php $years = range(2010, strftime('%Y', time())); ?>
                                    <select name="join_date" id="join_date" class="form-control">
                                        <option value="">All</option>
                                        <?php foreach($years as $year) : ?>
                                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                    <label for="">from </label>
                                    <input type="text" class="form-control" name="from" id="from" value="">

                                    <label for="">Filter by Holiday </label>
                                    <input type="month" class="form-control" name="holiday_year" id="holiday_year"
                                        value="">
                                </div>
                                <div class="col-4" style="color: black">

                                    <label for="">Filter By Department &nbsp;</label>
                                    <select class="form-control" name="department" id="department">
                                        <option value="">All</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="">Filter By Dob </label>
                                    <?php $years = range(1980, 2004); ?>
                                    <select name="dob" id="dob" class="form-control">
                                        <option value="">All</option>
                                        <?php foreach($years as $year) : ?>
                                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="">To </label>
                                    <input type="text" class="form-control" name="to" id="to" value="">

                                </div>
                                <div class="col-4">
                                    <label for="">Filter By Employe Type &nbsp;</label>
                                    <select class="form-control" name="empType" id="empType">
                                        <option value="">All</option>
                                        @foreach ($empTypies as $empType)
                                            <option value="{{ $empType->id }}">{{ $empType->name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="">Filter By Employe Salary </label>
                                    <input type="text" class="form-control" name="salary" id="salary" value="">

                                    <button id="filter_by_salary" class="mt-5 btn btn-success">Filter by Salary</button>
                                </div>

                                <div class="col-12">

                                    {{-- @if (Request::query('country', 'join_date', 'empType')) --}}
                                    <a class="mt-4 btn btn-danger offset-4 btn-lg w-25" href="{{ route('employee.index') }}">Clear
                                        Filetering</a>
                                    {{-- @endif --}}

                                </div>


                            </form>

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
                    <table class="table text-center font-weight-bold" id="dataTable" width="100%" style="color: black">
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
                        <tbody id="tbody">


                            @forelse ($employees as $employe)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td> {{ $employe->name ?? ' ' }}</td>
                                    <td>{{ $employe->department->name ?? ' ' }} </td>
                                    <td> {{ $employe->country->name ?? ' ' }} </td>
                                    <td>{{ $employe->employeType->name ?? '' }} </td>
                                    <td> {{ $employe->phone ?? '' }} </td>
                                    <td class="mt-4 text-white badge bg-primary rounded-pill">
                                        {{ $employe->dob ?? '' }}
                                    </td>
                                    <td>
                                        {{ $employe->join_date ?? '' }} </td>
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
                                            <form action="{{ route('employee.destroy', $employe->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="ml-2 btn btn-circle btn-danger "> <i
                                                        class="fas fa-trash "></i> </button>
                                            </form>
                                        </div>


                                    </td>


                                </tr>
                            @empty
                                <p>No Employee Found !</p>
                            @endforelse



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
        $(document).ready(function() {


            //  filtering by deparament
            $('#department').on('change', function() {
                var department = $("#department").val();

                $.ajax({
                    type: "GET",
                    url: "{{ route('employee.index') }}",
                    data: {

                        'department': department,
                    },
                    // dataType: "dataType",
                    success: function(data) {
                        var employees = data.employees;


                        var html = '';
                        var tbody = $('#tbody').html('');
                        var i;
                        if (employees.length > 0) {
                            employees.forEach(employe => {



                                html +=
                                    '<tr>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td></td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .department
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .country
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .employe_type
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .phone +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .dob +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .join_date +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .holiday_year +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .salaray +
                                    '</td>\
                                    <td><a type="button" href="/employee/'+employe.id+'/edit" value="' +
                                employe
                                .id +
                                '" class="btn btn-circle btn-success"><i class="fas fa-edit"></i></a> <a type="button" href="/employee/delete/'+employe.id+'" value="' +
                                employe
                                .id +
                                '" class="btn btn-circle btn-danger "><i class="fas fa-trash"></i></a> </td>\
                                      </tr> ';
                            });
                        } else {
                            html +=
                                '<tr>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>No Employee Found !</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </tr> ';
                        }
                        $('#tbody').html(html);
                    }
                });
            });


            //  filtering by country
            $('#country_filter').on('change', function() {
                country = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('employee.index') }}",
                    data: {
                        'country': country,
                    },
                    // dataType: "dataType",
                    success: function(data) {
                        var employees = data.employees;

                        var html = '';
                        if (employees.length > 0) {
                            employees.forEach(employe => {

                                html +=
                                    '<tr>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td></td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .department
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .country
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .employe_type
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .phone +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .dob +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .join_date +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .holiday_year +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .salaray +
                                    '</td>\
                                    <td><a type="button" href="/employee/'+employe.id+'/edit" value="' +
                                employe
                                .id +
                                '" class="btn btn-circle btn-success"><i class="fas fa-edit"></i></a> <a type="button" href="/employee/delete/'+employe.id+'" value="' +
                                employe
                                .id +
                                '" class="btn btn-circle btn-danger "><i class="fas fa-trash"></i></a> </td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </tr> ';
                            });
                        } else {
                            html +=
                                '<tr>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <td>No Employee Found !</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </tr> ';
                        }
                        $('#tbody').html(html);
                    }
                });


            });

            //filtering by employee Type
            $('#empType').on('change', function() {
                empType = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "{{ route('employee.index') }}",
                    data: {
                        'empType': empType,
                    },
                    // dataType: "dataType",
                    success: function(data) {
                        var employees = data.employees;

                        var html = '';
                        if (employees.length > 0) {
                            employees.forEach(employe => {

                                html +=
                                    '<tr>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td></td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td>' +
                                    employe
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td>' +
                                    employe
                                    .department
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td>' +
                                    employe
                                    .country
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td>' +
                                    employe
                                    .employe_type
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td>' +
                                    employe
                                    .phone +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td>' +
                                    employe
                                    .dob +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td>' +
                                    employe
                                    .join_date +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td>' +
                                    employe
                                    .holiday_year +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td>' +
                                    employe
                                    .salaray +
                                    '</td>\
                                    <td><a type="button" href="/employee/'+employe.id+'/edit" value="' +
                                employe
                                .id +
                                '" class="btn btn-circle btn-success"><i class="fas fa-edit"></i></a> <a type="button" href="/employee/delete/'+employe.id+'" value="' +
                                employe
                                .id +
                                '" class="btn btn-circle btn-danger "><i class="fas fa-trash"></i></a> </td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </tr> ';
                            });
                        } else {
                            html +=
                                '<tr>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <td>No Employee Found !</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </tr> ';
                        }
                        $('#tbody').html(html);
                    }
                });


            });

            //  filtering  Joining date  by year
            $('#join_date').on('change', function() {
                join_date = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "{{ route('employee.index') }}",
                    data: {
                        'join_date': join_date,
                    },
                    // dataType: "dataType",
                    success: function(data) {
                        var employees = data.employees;

                        var html = '';
                        if (employees.length > 0) {
                            employees.forEach(employe => {



                                html +=
                                    '<tr>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td></td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .department
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .country
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .employe_type
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .phone +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .dob +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .join_date +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .holiday_year +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .salaray +
                                    '</td>\
                                    <td><a type="button" href="/employee/'+employe.id+'/edit" value="' +
                                employe
                                .id +
                                '" class="btn btn-circle btn-success"><i class="fas fa-edit"></i></a> <a type="button" href="/employee/delete/'+employe.id+'" value="' +
                                employe
                                .id +
                                '" class="btn btn-circle btn-danger "><i class="fas fa-trash"></i></a> </td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </tr> ';
                            });
                        } else {
                            html +=
                                '<tr>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <td>No Employee Found !</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </tr> ';
                        }
                        $('#tbody').html(html);
                    }
                });


            });

            //  filtering  dob by year
            $('#dob').on('change', function() {
                dob = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('employee.index') }}",
                    data: {
                        'dob': dob,
                    },
                    // dataType: "dataType",
                    success: function(data) {
                        var employees = data.employees;

                        var html = '';
                        if (employees.length > 0) {
                            employees.forEach(employe => {

                                html +=
                                    '<tr>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td></td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .department
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .country
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .employe_type
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .phone +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .dob +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .join_date +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .holiday_year +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .salaray +
                                    '</td>\
                                    <td><a type="button" href="/employee/'+employe.id+'/edit" value="' +
                                employe
                                .id +
                                '" class="btn btn-circle btn-success"><i class="fas fa-edit"></i></a> <a type="button" href="/employee/delete/'+employe.id+'" value="' +
                                employe
                                .id +
                                '" class="btn btn-circle btn-danger "><i class="fas fa-trash"></i></a> </td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </tr> ';
                            });
                        } else {
                            html +=
                                '<tr>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <td>No Employee Found !</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </tr> ';
                        }
                        $('#tbody').html(html);
                    }
                });
            });

            //  filtering by salary
            $('#holiday_year').on('keyup', function() {
                holiday_year = $(this).val();
                console.log(holiday_year);
                $.ajax({
                    type: "GET",
                    url: "{{ route('employee.index') }}",
                    data: {
                        'holiday_year': holiday_year,
                    },
                    // dataType: "dataType",
                    success: function(data) {
                        var employees = data.employees;
                        console.log(employees);
                        var html = '';
                        if (employees.length > 0) {
                            employees.forEach(employe => {

                                html +=
                                    '<tr>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td></td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td>' +
                                    employe
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td>' +
                                    employe
                                    .department
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td>' +
                                    employe
                                    .country
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td>' +
                                    employe
                                    .employe_type
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td>' +
                                    employe
                                    .phone +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td>' +
                                    employe
                                    .dob +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td>' +
                                    employe
                                    .join_date +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td>' +
                                    employe
                                    .holiday_year +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td>' +
                                    employe
                                    .salaray +
                                    '</td>\
                                    <td><a type="button" href="/employee/'+employe.id+'/edit" value="' +
                                employe
                                .id +
                                '" class="btn btn-circle btn-success"><i class="fas fa-edit"></i></a> <a type="button" href="/employee/delete/'+employe.id+'" value="' +
                                employe
                                .id +
                                '" class="btn btn-circle btn-danger "><i class="fas fa-trash"></i></a> </td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </tr> ';
                            });
                        } else {
                            html +=
                                '<tr>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <td>No Employee Found !</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </tr> ';
                        }
                        $('#tbody').html(html);
                    }
                });
            });

            //  filtering by salary
            $('#salary').on('keyup', function() {
                salary = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "{{ route('employee.index') }}",
                    data: {
                        'salary': salary,
                    },
                    // dataType: "dataType",
                    success: function(data) {
                        var employees = data.employees;

                        var html = '';
                        if (employees.length > 0) {
                            employees.forEach(employe => {

                                html +=
                                    '<tr>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td></td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .department
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .country
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .employe_type
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .phone +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .dob +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .join_date +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .holiday_year +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .salaray +
                                    '</td>\
                                    <td><a type="button" href="/employee/'+employe.id+'/edit" value="' +
                                employe
                                .id +
                                '" class="btn btn-circle btn-success"><i class="fas fa-edit"></i></a> <a type="button" href="/employee/delete/'+employe.id+'" value="' +
                                employe
                                .id +
                                '" class="btn btn-circle btn-danger "><i class="fas fa-trash"></i></a> </td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </tr> ';
                            });
                        } else {
                            html +=
                                '<tr>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <td>No Employee Found !</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </tr> ';
                        }
                        $('#tbody').html(html);
                    }
                });
            });

            // filter salary by range
            $('#filter_by_salary').on('click', function(e) {
                e.preventDefault();

                from = $('#from').val();
                to = $('#to').val();
                console.log(from);
                $.ajax({
                    type: "GET",
                    url: "{{ route('employee.index') }}",
                    data: {
                        'from': from,
                        'to': to,
                    },
                    // dataType: "dataType",
                    success: function(data) {
                        var employees = data.employees;

                        var html = '';
                        if (employees.length > 0) {
                            employees.forEach(employe => {

                                html +=
                                    '<tr>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td></td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .department
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .country
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .employe_type
                                    .name +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .phone +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .dob +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .join_date +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .holiday_year +
                                    '</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>' +
                                    employe
                                    .salaray +
                                    '</td>\
                                    <td><a type="button" href="/employee/'+employe.id+'/edit" value="' +
                                employe
                                .id +
                                '" class="btn btn-circle btn-success"><i class="fas fa-edit"></i></a> <a type="button" href="/employee/delete/'+employe.id+'" value="' +
                                employe
                                .id +
                                '" class="btn btn-circle btn-danger "><i class="fas fa-trash"></i></a> </td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </tr> ';
                            });
                        } else {
                            html +=
                                '<tr>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <td>No Employee Found !</td>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </tr> ';
                        }
                        $('#tbody').html(html);
                    }
                });
            });

            // datatable
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
    </script>
@endsection
