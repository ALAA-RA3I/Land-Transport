@extends('main.layout')
@include('cdn.JQuery')
@include('cdn.Search_datatable')

<script>
    $(document).ready(function() {
        var table = $('#employeesTable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,  // Set the number of rows to display
            lengthChange: false,  // Disable the ability to change the number of rows shown
            ajax: '{{ route('showDrivers') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'Fname', name: 'Fname' },
                { data: 'Lname', name: 'Lname' },
                { data: 'email', name: 'email' },
                { data: 'hire_date', name: 'hire_date' },
                { data: 'phone_number', name: 'phone_number' },
                { data: 'birthday', name: 'birthday' },
                { data: 'year_experince', name: 'year_experince'},
                {
                    data: 'id',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <form action="{{ route('deleteDriver', '') }}/${data}" method="POST" style="display: inline;">
                                @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من حذف هذا السائق؟')" style=" position: relative ;right: 10px;">حذف</button>
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
                  <a  href="{{ route('editDriver', '') }}/${data}" class="btn btn-primary btn-sm" style=" position: relative ;right: 50px;">تعديل</a>
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

@section('titleOfPage','السائقين')

@section('title','السائقين')

@section('logoutORback', route('showMainLayout'))

@section('buttonText', 'عودة للقائمة الرئيسية')

@section('titleOfBox','سائقين الفرع ')

@section('linkValue','إنشاء حساب سائق جديد')

@section('route', route('addDriver'))

@section('content')
    <div class="container" >
        <!-- Success message -->
        @if (session('success'))
            <div id="successMessage" class="alert alert-success" style="width:400px; position: relative; top: 100px ;right: 300px;z-index: 1050; ">
                {{ session('success') }}
            </div>
        @endif
        <table id="employeesTable" class="table table-striped nowrap" style="width:500px ;font-size:medium  ">
            <thead>
            <tr>
                <th>ID</th>
                <th>الاسم الأول</th>
                <th>الاسم الاخير</th>
                <th>الايميل</th>
                <th>تاريخ التوظيف</th>
                <th>رقم الموبايل</th>
                <th>تاريخ الميلاد</th>
                <th>سنوات الخبرة</th>
                <th>حذف حساب</th>
                <th>تعديل معلومات الحساب</th>

            </tr>
            </thead>
        </table>

    </div>
@endsection



@include('components.button')
