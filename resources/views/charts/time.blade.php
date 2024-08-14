@extends('main.navBarLayout')

@section('titleOfPage','إحصائية الدفع')

@section('content')
        <div class="contentOfNavbar">
            <div class="chart-container">
                <div>
                    <h2 class="chart-title">احصائية الأوقات</h2>
                    <h4 class="chart-subtitle">تظهر هذه الاحصائية الأوقات الأكثر طلباً من قبل المستخدمين اللذين قاموا بالحجز يدوياً و إلكترونياً</h4>
                </div>

                {!! $chart->container() !!}
            
                <script src="{{ $chart->cdn() }}"></script>
            
                {{ $chart->script() }}
            </div>
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

.chart-container {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>