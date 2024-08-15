<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titleOfPage', 'القائمة الرئيسية')</title>
    <link href="{{asset('css/master.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>


</head>
<body>
<div class="parent">
            <div class="sidebar">
                <img src="{{asset('Images/325459617_681733463736687_8393534721802801786_n.png')}}">
                <ul class="choises">
                    <a href="{{ route ('showTripsSection') }}"><li>الرحلات</li></a>
                    <a href="#"><li>جدولة الرحلات</li></a>
                    <a href="{{route('showAvaliableTripsForBooking')}}"><li>اضافة حجز يدوي</li></a>
                    <a href="{{route('showCurrentTrips')}}"><li>الرحلات الجارية الان</li></a>
                    <a href="{{route('showBusSection')}}"><li>الحافلات</li></a>
                    <a href="{{route('showDrivers')}}"><li>السائقين</li></a>
                </ul>
                <a class="logout" href="@yield('logoutORback',route('logout'))">@yield('buttonText', 'تسجيل الخروج')</a>
                </div>
            <div class="navigation">
                <ul class="links">
                    <a href="{{route('showTripsSection')}}"><li>رحلات</li></a>
                    <a href="{{route('showTickets')}}"><li>تذاكر</li></a>
                    <a href="{{route('showCopouns')}}"><li>كوبونات</li></a>
                    <a href="{{ route('statistcsSection') }}"><li>إحصائيات</li></a>
                </ul>

                @hasSection('title')
                <div class="title">
                    <p>@yield('titleOfBox','قم باختيار احد الروابط')</p>
                </div>

                @endif
                @if (Request::is('manager/dashboard'))
                    <img class="main" src="{{asset('Images/لوغو زريق.png كحلي.png')}}" alt="">
                @endif
                @hasSection('content')
                    <div class="content">

                    @yield('content','')
                </div>

                @endif
                    </div>
        </div>
</div>
</body>
</html>
