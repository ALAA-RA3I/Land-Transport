<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titleOfPage', 'الإحصائيات')</title>
    <link href="{{asset('css/master.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</head>
<body>
<div class="parent">
            <div class="sidebar">
                <img src="{{asset('Images/325459617_681733463736687_8393534721802801786_n.png')}}">
                <ul class="choises">
                    <a href="{{route('paymentTypeStatistics')}}"><li>إحصائية نوع الدفع</li></a>
                    <a href="{{ route('ageStatistics') }}"><li>إحصائية الأعمار </li></a>
                    <a href="#"><li>إحصائية الأوقات الأكثر طلباً</li></a>
                </ul>
                <a class="logout" href="@yield('logoutORback',route('showMainLayout'))">@yield('buttonText', 'العودة للقائمة الرئيسية')</a>
            </div>
            <div class="navigation">
                <ul class="links">
                    <a href="#"><li>رحلات</li></a>
                    <a href="#"><li>تذاكر</li></a>
                    <a href="{{route('showCopouns')}}"><li>كوبونات</li></a>
                    <a href="{{route('statistcsSection')}}"><li>إحصائيات</li></a>
                </ul>
            </div>

                @if (Request::is('manager/showStatistics'))
                <img class="main" src="{{asset('Images/لوغو زريق.png كحلي.png')}}" alt="">
                @endif

                @hasSection('content')
                    @yield('content','')
                @endif
</div>
</body>
</html>
