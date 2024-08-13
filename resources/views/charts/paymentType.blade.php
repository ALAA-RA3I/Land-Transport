@extends('main.navBarLayout')

@section('titleOfPage','إحصائية الدفع')

@section('content')
        <div class="contentOfNavbar">
        <div>
            <h2 class="chart-title">احصائية نوع الدفع</h2>
            <h4 class="chart-subtitle">تظهر هذه الاحصائية اعداد المستخدمين اللذين قاموا بالحجز يدوياً و إلكترونياً</h4>
        </div>

        {!! $chart->container() !!}
    
        <script src="{{ $chart->cdn() }}"></script>
    
        {{ $chart->script() }}
        </div>
@endsection

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