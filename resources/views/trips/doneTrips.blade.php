@extends('main.layout')
@include('cdn.JQuery')
@include('cdn.Search_datatable')

<script>
    $(document).ready(function() {
        var table = $('#DoneTripsTable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,  // Set the number of rows to display
            lengthChange: false,  // Disable the ability to change the number of rows shown
            ajax: '{{ route('showDoneTrips',) }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'trip_num', name: 'trip_num' },
                { data: 'date', name: 'date' },
                { data: 'start_trip', name: 'start_trip' },
                { data: 'end_trip', name: 'end_trip' },
                { data: 'driver_name', name: 'driver_name' },  // Display the driver's name
                { data: 'bus_name', name: 'bus_name' },            // Display the bus name
                { data: 'source', name: 'source' },                 // Display the source location
                { data: 'destination', name: 'destination' },  // Display the destination location
                {  data: 'id',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                  <a  href="{{ route('showDoneTripTickets', '')}}/${data}" class="btn btn-info">عرض المسافرين</a>
                    `;
                    }
                }
            ],
            responsive: true,
        });

        // Hide the success message after 3 seconds
        setTimeout(function() {
            $('#successMessage').fadeOut('slow');
        }, 3000); // 3 seconds
    });
</script>


@section('titleOfPage','الرحلات المنجزة')

@section('title','الرحلات المنجزة')

@section('titleOfBox','الرحلات المنجزة ')

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
        <table id="DoneTripsTable" class="table table-striped nowrap" style="width:500px ;font-size:medium  ">
            <thead>
            <tr>
                <th>ID</th>
                <th>رقم الرحلة</th>
                <th>تاريخ الرحلة</th>
                <th>وقت الانطلاق </th>
                <th>وقت الوصول </th>
                <th>السائق</th>
                <th>رقم الباص </th>
                <th>من</th>
                <th>إلى</th>
                <th>تفاصيل المسافرين</th>


            </tr>
            </thead>
        </table>

    </div>
@endsection



