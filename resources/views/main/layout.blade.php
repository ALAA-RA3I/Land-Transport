<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titleOfPage', 'MOAYAD')</title>
    <link href="{{asset('css/master.css')}}" rel="stylesheet">
</head>
<body>
<div class="parent">
            <div class="sidebar">
                <img src="{{url('images/325459617_681733463736687_8393534721802801786_n.png')}}">
                <ul class="choises">
                     <a href="#"><li>MOAYAD</li></a>
                     <a href="#"><li>رحلات مجدولة</li></a>
                     <a href="#"><li>الرحلات الحالية</li></a>
                     <a href="{{route('showBusSection')}}"><li>الحافلات</li></a>
                     <a href="#"><li>السائقين</li></a>
                    <a href="{{ route ('showTripsSection') }}"><li>رحلات</li></a>
                    <a href="#"><li>رحلات مجدولة</li></a>
                    <a href="#"><li>الرحلات الحالية</li></a>
                    <a href="{{ route ('showBusSection') }}"><li>الحافلات</li></a>
                    <a href="#"><li>السائقين</li></a>

                </ul>
                <a class="logout" href="{{route('logout')}}">@yield('buttonText', 'تسجيل الخروج')</a>
                </div>
            <div class="navigation">
                <ul class="links">
                    <a href="#"><li>رحلات</li></a>
                    <a href="#"><li>تذاكر</li></a>
                    <a href="#"><li>كوبونات</li></a>
                    <a href="#"><li>إحصائيات</li></a>
                </ul>
                @hasSection('title')
                <div class="title">
                    <p>@yield('titleOfBox','قم باختيار احد الروابط')</p>
                </div>
                @endif
                @if (Request::is('main'))
                    <img class="main" src="images/لوغو زريق.png رمادي.png" alt="">
                @endif
                @hasSection('content')
                <div class="content">
                    @yield('content','')
                </div>
                @endif
            </div>
        </div>
</body>
</html>
