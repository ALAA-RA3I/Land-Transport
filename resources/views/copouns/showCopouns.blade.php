<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titleOfPage', 'القائمة الرئيسية')</title>
    <link href="{{ asset('css/master.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/firebase.js') }}"></script>
</head>
<body>

    @extends('main.layout')

    @section('titleOfPage', 'كوبونات')
    @section('title', 'كوبونات')
    @section('logoutORback', route('showMainLayout'))
    @section('buttonText', 'عودة للقائمة الرئيسية')
    @section('titleOfBox', 'الكوبونات ')

    @if ($errors->any())
        <script>        
            let errorMessages = '';
            @foreach ($errors->all() as $error)
                errorMessages += '{{ $error }}\n';
            @endforeach
            alert(errorMessages);
        </script>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @section('content')
    <div class="container mt-4">
        <!-- زر إضافة كوبون -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">الكوبونات الحالية</h3>
            <a href="{{ route('couponsForCreate') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> إضافة كوبون
            </a>
        </div>

        <!-- جدول الكوبونات -->
        <table class="table table-striped table-dark">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">اسم الكوبون</th>
                    <th scope="col">عدد الكراسي</th>
                    <th scope="col">عدد الكراسي المجانية</th>
                    <th scope="col"></th> <!-- Action column -->
                </tr>
            </thead>
            <tbody>
                @foreach($coupons as $coupon)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th> <!-- استخدام رقم التكرار -->
                    <td>{{ $coupon['name'] }}</td>
                    <td>{{ $coupon['num_chair'] }}</td>
                    <td>{{ $coupon['free_chair'] }}</td>
                    <td>
                        <!-- Trigger the modal -->
                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-couponid="{{ $coupon['id'] }}">
                            حذف     
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    هل أنت متأكد أنك تريد حذف هذا الكوبون؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/firebase.js') }}"></script>

    <script>
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const couponId = button.getAttribute('data-couponid');
            const form = deleteModal.querySelector('#deleteForm');
            form.action = `coupons/${couponId}`;
        });
    </script>

    @endsection

</body>
</html>
