@if (session('good'))
    <script>
        alert('{{ session('good') }}');
    </script>
@endif
@extends('main.layout')
@include('cdn.JQuery')
@include('cdn.cdn')



@if ($errors->any())
    <script>
        let errorMessages = '';
        @foreach ($errors->all() as $error)
            errorMessages += '{{ $error }}\n';
        @endforeach
        alert(errorMessages);
    </script>
@endif

@section('titleOfPage','الرحلات')

@section('title','رحلات')

@section('titleOfBox','الرحلات ')

@section('logoutORback', route('showMainLayout'))

@section('buttonText', 'عودة للقائمة الرئيسية')

@section('linkValue','إضافة رحلة استثنائية')

@section('route', route('addTripInfo'))
<a href="#">
<div class="card text-bg-primary" style="width: 20% ; position: absolute ; top: 200px ; right: 550px ;border-radius: 5px;border-color: blanchedalmond">
<div class="card-header" style="background-color:#e1ad21; color:#2d3748 ;font-weight: bolder">{{\App\Models\Trip::where('status','Done')->count()}}</div>
<div class="card-body" style="background-color:#f8c62d ;color: #2d3748 ;font-weight: bolder">
    <h5 class="card-title" style="font-size: x-large">الرحلات المنجزة</h5>
    <span style="font-size: x-small">انقر لرؤية التفاصيل</span>
</div>
</div>
</a>

<a href="#">
<div class="card text-bg-primary" style="width: 20% ; position: absolute ; top: 200px ; right: 1100px ; border-radius: 5px; border-color: blanchedalmond">
    <div class="card-header" style="background-color:#e1ad21  ; color: #2d3748 ;font-weight: bolder" >{{\App\Models\Trip::where('status','Wait')->count()}}</div>
    <div class="card-body" style="background-color:#f8c62d ; color: #2d3748 ;font-weight: bolder">
        <h5 class="card-title" style="font-size: x-large">الرحلات قيد الانتظار</h5>

        <span style="font-size: x-small">انقر لرؤية التفاصيل</span>
    </div>
</div>
</a>

<a href="{{route('showCurrentTrips')}}">
    <div class="card text-bg-primary" style="width: 20%  ; position: absolute ; top: 400px ; right: 825px ; border-radius: 5px; border-color: blanchedalmond">
        <div class="card-header" style="background-color:#e1ad21  ; color: #2d3748 ;font-weight: bolder" >{{\App\Models\Trip::where('status','Progress')->count()}}</div>
        <div class="card-body" style="background-color:#f8c62d ; color: #2d3748 ;font-weight: bolder">
            <h5 class="card-title" style="font-size: x-large"> الرحلات الجارية الان</h5>

            <span style="font-size: x-small">انقر لرؤية التفاصيل</span>
        </div>
    </div>
</a>


@include('components.button')
