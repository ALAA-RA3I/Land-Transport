<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titleOfPage', 'الإحصائيات')</title>
    <link href="{{asset('css/master.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <style>
        .chart-title {
    text-align: center;
    font-size: 24px;
    margin-top: 0px;
    font-weight: bold;
}

.chart-subtitle {
    text-align: center;
    font-size: 16px;
    margin-top: 2px;
    color: #666;
}

    </style>
</head>
<body>
<div class="parent">
            <div class="sidebar">
                <img src="{{asset('Images/325459617_681733463736687_8393534721802801786_n.png')}}">
                <ul class="choises">
                    <a href="{{route('paymentTypeStatistics')}}"><li>إحصائية نوع الدفع</li></a>
                    <a href="#"><li>إحصائية الأعمار </li></a>
                    <a href="#"><li>إحصائية الأوقات الأكثر طلباً</li></a>
                </ul>
                <a class="logout" href="@yield('logoutORback',route('showMainLayout'))">@yield('buttonText', 'العودة للقائمة الرئيسية')</a>
                </div>
            <div class="navigation">
                <ul class="links">
                    <a href="#"><li>رحلات</li></a>
                    <a href="#"><li>تذاكر</li></a>
                    <a href="{{route('showCopouns')}}"><li>كوبونات</li></a>
                    <a href="#"><li>إحصائيات</li></a>
                </ul>

                @if (Request::is('manager/showStatistics'))
                <img class="main" src="{{asset('Images/لوغو زريق.png كحلي.png')}}" alt="">
                @endif

                @hasSection('content')
                    <div class="contentOfNavbar">
                        <!doctype html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport"
                            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                            <meta http-equiv="X-UA-Compatible" content="ie=edge">
                        </head>
                        <body>
                            <div>
                                <h2 class="chart-title">احصائية نوع الدفع</h2>
                                <h4 class="chart-subtitle">تظهر هذه الاحصائية اعداد المستخدمين اللذين قاموا بالحجز يدوياً و إلكترونياً</h4>
                            </div>
                        
                            {!! $chart->container() !!}
                        
                            <script src="{{ $chart->cdn() }}"></script>
                        
                            {{ $chart->script() }}
                        </body>
                        </html>
                    </div>
                @endif
        </div>
</div>
</body>
</html>
