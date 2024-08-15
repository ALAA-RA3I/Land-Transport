@extends('main.layout')
@include('cdn.JQuery')
@include('cdn.Search_datatable')

<script>
    $(document).ready(function() {
        var table = $('#WaitTripsTable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,  // Set the number of rows to display
            lengthChange: false,  // Disable the ability to change the number of rows shown
            ajax: '{{ route('showWaitTrips') }}',
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
                  <a  href="{{ route('showWaitTripTickets', '')}}/${data}" class="btn btn-info">عرض المسافرين</a>
                    `;
                    }
                },
                {  data: 'id',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                  <a  href="{{ route('editWaitTrip', '')}}/${data}" class="btn btn-warning" data-mdb-ripple-init">تعديل الرحلة</a>
                    `;
                    }
                },
                {
                    data: 'id',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <form action="{{route('deleteWaitTrip', '')}}/${data}" method="POST" style="display: inline;">
                                @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذه الرحلة ؟؟ سوف يتم حذف الحجوزات الخاصة بها ايضاً')" style=" position: relative ;right: 10px;"> حذف الرحلة</button>
                    </form>
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


@section('titleOfPage','الرحلات قيد الانتظار')

@section('title','الرحلات قيد الانتظار')

@section('titleOfBox','الرحلات قيد الانتظار ')

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
        <table id="WaitTripsTable" class="table table-striped nowrap" style="width:500px ;font-size:medium  ">
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
                <th>تفاصيل المسافرين</th>
                <th>تعديل معلومات الرحلة</th>
                <th>حذف الرحلة</th>
            </tr>
            </thead>
        </table>

    </div>
@endsection



