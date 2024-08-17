@extends('main.layout')
@include('cdn.JQuery')
@include('cdn.Search_datatable')

<script>
    $(document).ready(function() {
        var table = $('#ShowTicketsTable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,  // Set the number of rows to display
            lengthChange: false,  // Disable the ability to change the number of rows shown
            ajax: '{{ route('showDoneTripTickets', $id) }}',
            columns: [
                { data: 'id', name: 'id' ,searchable: false  },
                { data: 'tickets_num', name: 'tickets_num',searchable: true },
                { data: 'first_name', name: 'first_name' ,searchable: true },
                { data: 'mid_name', name: 'mid_name' ,searchable: true },
                { data: 'last_name', name: 'last_name' ,searchable: true },
                { data: 'chair_num', name: 'chair_num' ,searchable: false },
                {
                    data: 'is_used',
                    name: 'is_used',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        if (data) {
                            return '<button class="btn btn-success" style="width: 100px">Active</button>';
                        } else {
                            return '<button class="btn btn-danger">NonActive</button>';
                        }
                    }
                },
                {
                    data: 'presence_travellet',
                    name: 'presence_travellet',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        if (data) {
                            return '<button class="btn btn-success">✓</button>';
                        } else {
                            return '<button class="btn btn-danger">✘</button>';
                        }
                    }
                },
                { data: 'age', name: 'age' ,searchable: false},
                { data: 'booking_date', name: 'booking_date',searchable: false },
                { data: 'booking_type', name: 'booking_type',searchable: false },
                { data: 'trip_number', name: 'trip_number' ,searchable: false},
            ],
            responsive: true,
        });

        // Hide the success message after 3 seconds
        setTimeout(function() {
            $('#successMessage').fadeOut('slow');
        }, 3000); // 3 seconds
    });
</script>


@section('titleOfPage','تذاكر الرحلة المنجزة')

@section('title','تذاكر الرحلة المنجزة')

@section('titleOfBox','تذاكر الرحلة المنجزة ')

@section('logoutORback', route('showMainLayout'))

@section('buttonText', 'عودة للقائمة الرئيسية')


@section('content')
    <div class="container" >
        <!-- Success message -->
        @if (session('success'))
            <div id="successMessage" class="alert alert-success" style="width:400px; position: relative; top: 100px ;right: 300px;z-index: 1050; ">
                {{ session('success') }}
            </div>
        @endif
        <table id="ShowTicketsTable" class="table table-striped nowrap" style="width:500px ;font-size:medium  ">
            <thead>
            <tr>
                <th>ID</th>
                <th>رقم التذكرة</th>
                <th>الاسم الاول</th>
                <th>الاسم الاوسط</th>
                <th>الاسم الاخير </th>
                <th>المقعد المحجوز</th>
                <th>فعالية التذكرة</th>
                <th>حضور الراكب</th>
                <th>العمر </th>
                <th>تاريخ الحجز</th>
                <th>نوع الحجز</th>
                <th>رقم الرحلة</th>
            </tr>
            </thead>
        </table>

    </div>
@endsection



