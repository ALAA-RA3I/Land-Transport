@extends('main.layout')
@include('cdn.JQuery')
@include('cdn.cdn')
<style>
    /* Add styles for the switch */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
    }
    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        border-radius: 50%;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
    }
    input:checked + .slider {
        background-color: #2196F3;
    }
    input:checked + .slider:before {
        transform: translateX(26px);
    }
    .slider.round {
        border-radius: 34px;
    }
    .slider.round:before {
        border-radius: 50%;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{asset('css/scheduled.css')}}" rel="stylesheet">

@section('titleOfPage','جدولة الرحلات')


@component('components.button')
    @section('linkValue', 'إضافة جدولة رحلات')
    @section('route', route('addScheduledTrip'))
@endcomponent


@section('logoutORback', route('showMainLayout'))

@section('buttonText', 'عودة للقائمة الرئيسية')


@section('title','رحلات')
@section('titleOfBox','استعراض أيام الجدولة')
<script>    setTimeout(function() {
        $('#successMessage').fadeOut('slow');
    }, 3000); // 3 seconds</script>

@if (session('success'))
    <div id="successMessage" class="alert alert-success" style="width:400px; position: absolute; top: 100px ;right: 800px;z-index: 1050; ">
        {{ session('success') }}
    </div>
@endif
<div class="all">
    <div class="allDivs" style="display: flex; flex-wrap: wrap; justify-content: space-evenly; margin-top:30px">
        <a href="{{route('showSchedulingTrips','السبت')}}" style="width: 40%; margin-bottom: 20px; text-decoration: none; color: inherit;">
            <div class="card text-bg-primary" style="width: 100%; border-radius: 5px; border-color: blanchedalmond;">
                <div class="card-header" style="background-color:#e1ad21; color:#2d3748; font-weight: bolder">السبت</div>
                <div class="card-body" style="background-color:#f8c62d; color:#2d3748; font-weight: bolder">
                    <h5 class="card-title" style="font-size: x-large">تفاصيل رحلات السبت</h5>
                    <span style="font-size: x-small">انقر لرؤية التفاصيل</span>
                </div>
            </div>
        </a>

        <a href="{{route('showSchedulingTrips' , 'الاحد')}}" style="width: 40%; margin-bottom: 20px;text-decoration: none; color: inherit;">
            <div class="card text-bg-primary" style="width: 100%; border-radius: 5px; border-color: blanchedalmond;">
                <div class="card-header" style="background-color:#e1ad21; color:#2d3748; font-weight: bolder">الاحد</div>
                <div class="card-body" style="background-color:#f8c62d; color:#2d3748; font-weight: bolder">
                    <h5 class="card-title" style="font-size: x-large">تفاصيل رحلات يوم الاحد</h5>
                    <span style="font-size: x-small">انقر لرؤية التفاصيل</span>
                </div>
            </div>
        </a>

        <a href="{{route('showSchedulingTrips' , 'الأثنين')}}" style="width: 40%; margin-bottom: 20px; text-decoration: none; color: inherit;">
            <div class="card text-bg-primary" style="width: 100%; border-radius: 5px; border-color: blanchedalmond;">
                <div class="card-header" style="background-color:#e1ad21; color:#2d3748; font-weight: bolder">الاثنين</div>
                <div class="card-body" style="background-color:#f8c62d; color:#2d3748; font-weight: bolder">
                    <h5 class="card-title" style="font-size: x-large">تفاصيل رحلات يوم الاثنين</h5>
                    <span style="font-size: x-small">انقر لرؤية التفاصيل</span>
                </div>
            </div>
        </a>

        <a href="{{route('showSchedulingTrips' , 'الثلاثاء')}}" style="width: 40%; margin-bottom: 20px; text-decoration: none; color: inherit;">
            <div class="card text-bg-primary" style="width: 100%; border-radius: 5px; border-color: blanchedalmond;">
                <div class="card-header" style="background-color:#e1ad21; color:#2d3748; font-weight: bolder">الثلاثاء</div>
                <div class="card-body" style="background-color:#f8c62d; color:#2d3748; font-weight: bolder">
                    <h5 class="card-title" style="font-size: x-large">تفاصيل رحلات يوم الثلاثاء</h5>
                    <span style="font-size: x-small">انقر لرؤية التفاصيل</span>
                </div>
            </div>
        </a>

        <a href="{{route('showSchedulingTrips' , 'الاربعاء')}}" style="width: 40%; margin-bottom: 20px; text-decoration: none; color: inherit;">
            <div class="card text-bg-primary" style="width: 100%; border-radius: 5px; border-color: blanchedalmond;">
                <div class="card-header" style="background-color:#e1ad21; color:#2d3748; font-weight: bolder">الاربعاء</div>
                <div class="card-body" style="background-color:#f8c62d; color:#2d3748; font-weight: bolder">
                    <h5 class="card-title" style="font-size: x-large">تفاصيل رحلات يوم الاربعاء</h5>
                    <span style="font-size: x-small">انقر لرؤية التفاصيل</span>
                </div>
            </div>
        </a>

        <a href="{{route('showSchedulingTrips' , 'الخميس')}}" style="width: 40%; margin-bottom: 20px; text-decoration: none; color: inherit;">
            <div class="card text-bg-primary" style="width: 100%; border-radius: 5px; border-color: blanchedalmond;">
                <div class="card-header" style="background-color:#e1ad21; color:#2d3748; font-weight: bolder">الخميس</div>
                <div class="card-body" style="background-color:#f8c62d; color:#2d3748; font-weight: bolder">
                    <h5 class="card-title" style="font-size: x-large">تفاصيل رحلات يوم الخميس</h5>
                    <span style="font-size: x-small">انقر لرؤية التفاصيل</span>
                </div>
            </div>
        </a>

        <a href="{{route('showSchedulingTrips' , 'الجمعة')}}" style="width: 40%; margin-bottom: 20px; text-decoration: none; color: inherit;">
            <div class="card text-bg-primary" style="width: 100%; border-radius: 5px; border-color: blanchedalmond;">
                <div class="card-header" style="background-color:#e1ad21; color:#2d3748; font-weight: bolder">الجمعة</div>
                <div class="card-body" style="background-color:#f8c62d; color:#2d3748; font-weight: bolder">
                    <h5 class="card-title" style="font-size: x-large">تفاصيل رحلات يوم الجمعة</h5>
                    <span style="font-size: x-small">انقر لرؤية التفاصيل</span>
                </div>
            </div>
        </a>
    </div>
    </div>
<h4 style="position: absolute ;top: 30px ; right: 1125px ; color: #f8c62d" >التحكم بالجدولة</h4>

<a href="{{route('Onscheduling')}}" class="btn btn-success" style="position: absolute ;top: 30px ; right: 1300px">تشغيل</a>
<a href="{{route('Offscheduling')}}" class="btn btn-danger" style="position: absolute ;top: 30px ; right: 1380px">إيقاف</a>

</div>


