@extends('main.layout')
@include('cdn.JQuery')
@include('cdn.Search_datatable')

<script>
    $(document).ready(function() {
        var table = $('#CurrentTripsTable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,  // Set the number of rows to display
            lengthChange: false,  // Disable the ability to change the number of rows shown
            ajax: '{{ route('showCurrentTrips') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'trip_num', name: 'trip_num' },
                { data: 'date', name: 'date' },
                { data: 'start_trip', name: 'start_trip' },
                { data: 'end_trip', name: 'end_trip' },
                { data: 'available_chair', name: 'available_chair' },
                { data: 'cost', name: 'cost' },
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
                  <a  href="{{ route('FollowTripOnMap', '')}}/${data}" class="btn btn-info">تتبع الرحلة</a>
                    `;
                    }
                }
            ],
            responsive: true,
        });

        // Hide the success message after 3 seconds

    });
</script>


@section('titleOfPage','الرحلات الجارية')

@section('title','الرحلات الجارية')

@section('titleOfBox','الرحلات الجارية ')

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
        <table id="CurrentTripsTable" class="table table-striped nowrap" style="width:500px ;font-size:medium  ">
            <thead>
            <tr>
                <th>ID</th>
                <th>رقم الرحلة</th>
                <th>تاريخ الرحلة</th>
                <th>وقت الانطلاق </th>
                <th>وقت الوصول </th>
                <th>المقاعد المتوفرة</th>
                <th>التكلفة</th>
                <th>السائق</th>
                <th>رقم الباص </th>
                <th>من</th>
                <th>إلى</th>
                <th>تتبع مسار الرحلة</th>


            </tr>
            </thead>
        </table>

    </div>
@endsection



