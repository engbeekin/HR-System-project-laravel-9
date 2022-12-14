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


                                </div>
                                <div class="col-4">
                                    <label for="">Filter By Employe Type &nbsp;</label>
                                    <select class="form-control" name="empType" id="empType">
                                        <option value="">All</option>
                                        @foreach ($empTypies as $empType)
                                            <option value="{{ $empType->id }}">{{ $empType->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="">Filter by Holiday </label>
                                    <input type="month" class="form-control" name="holiday_year" id="holiday_year"
                                        value="">

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
               getEmploye();
            });

            //  filtering by country

            $('#country_filter').on('change', function () {
                    getEmploye();
            });
            $('#empType').on('change', function () {
                    getEmploye();
            });

             $('#join_date').on('change', function () {
                    getEmploye();
            });

             $('#dob').on('change', function () {
                    getEmploye();
            });
            $('#salary').on('keyup', function () {
                    getEmploye();
            });

            $('#holiday_year').on('keyup', function () {
                    getEmploye();
            });

            $('#from,#to').on('keyup', function () {
                    getEmploye();
            });
            // datatable
            $('#dataTable').DataTable({
                // dom: 'Bfrtip',
                dom: "Blfrtip",
                select: true,

                buttons: [{
                        extend: 'pdfHtml5',
                        text: '<button  class="px-3 btn btn-primary w-100 "><i class="mr-1 fa fa-file-pdf "></i> PDF</button>',

                        title: 'All Employee List',
                        exportOptions: {
                            columns: ':visible:not(.not-export)',
                             rows : {country_filter:'applied'}
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
                        },

                    },
                ]


            });


        });

        // get employee filtered data
        function getEmploye(){
            var country=$('#country_filter').val();
            var department=$('#department').val();
            var empType=$('#empType').val();
            var join_date=$('#join_date').val();
            var dob=$('#dob').val();
            var salary=$('#salary').val();
            var holiday_year=$('#holiday_year').val();
            var from=$('#from').val();
            var to=$('#to').val();


            $.ajax({
                    type: "GET",
                    url: "{{ route('employee.index') }}",
                    data: {
                        'country': country,
                        'department': department,
                        'empType': empType,
                        'join_date': join_date,
                        'dob': dob,
                        'salary': salary,
                        'holiday_year': holiday_year,
                        'from': from,
                        'to': to,
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
        }


    </script>

@endsection
