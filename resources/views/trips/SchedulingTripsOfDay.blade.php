@extends('main.layout')
@include('cdn.JQuery')
@include('cdn.Search_datatable')

<script>
    $(document).ready(function() {
        var table = $('#SchedulingTripsTable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,  // Set the number of rows to display
            lengthChange: false,  // Disable the ability to change the number of rows shown
            ajax: '{{ route('showSchedulingTrips',$day) }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'day_name', name: 'day_name' },
                { data: 'start_trip', name: 'start_trip' },
                { data: 'end_trip', name: 'end_trip' },
                { data: 'cost', name: 'cost' },
                { data: 'driver_name', name: 'driver_name' },
                { data: 'bus_name', name: 'bus_name' },
                { data: 'source', name: 'source' },
                { data: 'destination', name: 'destination' },
                {
                    data: 'id',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <form action="{{route('deleteSchedulingTrip', '')}}/${data}" method="POST" style="display: inline;">
                                @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من حذف معلومات الجدولة لهذه الرحلة ؟؟ ً')" style=" position: relative ;right: 10px;"> حذف </button>
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


@section('titleOfPage','معلومات الرحلات المجدولة')

@section('title','الرحلات المجدولة')

@section('titleOfBox','الرحلات المجدولة ')

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
        <table id="SchedulingTripsTable" class="table table-striped nowrap" style="width:500px ;font-size:medium  ">
            <thead>
            <tr>
                <th>ID</th>
                <th>اليوم</th>
                <th>وقت الانطلاق </th>
                <th>وقت الوصول </th>
                <th>التكلفة</th>
                <th>السائق</th>
                <th>رقم الباص </th>
                <th>من</th>
                <th>إلى</th>
                <th>حذف معلومات الرحلة</th>


            </tr>
            </thead>
        </table>

    </div>
@endsection



