@extends('main.layout')
@include('cdn.JQuery')
@include('cdn.Search_datatable')

<script>
    $(document).ready(function() {
        var table = $('#BusesTable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,  // Set the number of rows to display
            lengthChange: false,  // Disable the ability to change the number of rows shown
            ajax: '{{ route('showBusSection') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'bus_name', name: 'bus_name' },
                { data: 'model', name: 'model' },
                { data: 'type', name: 'type' },
                { data: 'bus_number', name: 'bus_number' },
                { data: 'chair_count', name: 'chair_count' },
                {
                    data: 'id',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <form action="{{ route('deleteBus', '') }}/${data}" method="POST" style="display: inline;">
                                @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من حذف هذا الباص؟')"> حذف الباص</button>
                    </form>
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
                  <a  href="{{ route('editBus', '') }}/${data}" class="btn btn-primary btn-sm" style="position: absolute ;right: 1450px">تعديل</a>
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

@section('titleOfPage','الحافلات')

@section('title','الحافلات')

@section('logoutORback', route('showMainLayout'))

@section('buttonText', 'عودة للقائمة الرئيسية')

@section('titleOfBox','الحافلات المتوفرة ')

@section('linkValue','إضافة حافلة جديدة')

@section('route', route('busInfo'))


@section('content')
    <div class="container" >
        <!-- Success message -->
        @if (session('success'))
            <div id="successMessage" class="alert alert-success" style="width:400px; position: relative; top: 100px ;right: 300px;z-index: 1050; ">
                {{ session('success') }}
            </div>
        @endif
        <table id="BusesTable" class="table table-striped nowrap" style="width:500px ;font-size:medium  ">
            <thead>
            <tr>

                <th>ID</th>
                <th>اسم الباص </th>
                <th>الموديل </th>
                <th>النوع </th>
                <th> رقم الباص </th>
                <th>عدد المقاعد </th>
                <th> حذف الباص</th>
                <th>تعديل معلومات الباص</th>
            </tr>
            </thead>
        </table>

    </div>
@endsection


@include('components.button')

