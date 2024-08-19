@extends('main.layout')
@include('cdn.JQuery')
@include('cdn.Search_datatable')
<link href="{{asset('css/seconde.css')}}" rel="stylesheet">

<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#successMessage').fadeOut('slow');
        }, 3000); // 3 seconds
    });
</script>


@section('titleOfPage',' إضافة معلومات جدولة الرحلات')

@section('logoutORback', route('showMainLayout'))

@section('buttonText', 'عودة للقائمة الرئيسية')



@section('content')

    @if (session('success'))
        <div id="successMessage" class="alert alert-success" style="width:400px; position: absolute; top: 100px ;right: 800px;z-index: 1050; ">
            {{ session('success') }}
        </div>
    @endif
    <div class="all">
        <form action="{{ route('storeScheduledInfo') }}" method="POST">
        @csrf
        <label for="day">أختر يوماً</label>
        <select name="day_name" id="">
            <option value="الأثنين">الأثنين</option>
            <option value="الثلاثاء">الثلاثاء</option>
            <option value="الاربعاء">الأربعاء</option>
            <option value="الخميس">الخميس</option>
            <option value="الجمعة">الجمعة</option>
            <option value="السبت">السبت</option>
            <option value="الاحد">الاحد</option>
        </select>
        <label for="start-trip">أدخل وقت الانطلاق</label>
        <input
            type="time"
            name="start_trip"
            id="start-trip"
        >
        <label for="end-trip">أدخل وقت الوصول</label>
        <input
            type="time"
            name="end_trip"
            id="end-trip"
        >
        <label for="driver">أختر السائق</label>
        <select
            name="Driver_id"
            id="driver"
        >
        @foreach ($drivers as $driver)
            <option value="{{ $driver->id }}">{{ $driver->full_name}}</option>
        @endforeach
        </select>
        <label for="bus">اختر الحافلة</label>
        <select
            name="Bus_id"
            id="bus"
        >
        @foreach($buses as $bus)
            <option value="{{ $bus->id }}">{{ $bus->bus_number }}</option>
        @endforeach
        </select>
        <label for="from-to">اختر الوجهة</label>
        <select name="From_To_id" id="from-to">
            @foreach ($places as $id => $destination)
                <option value="{{ $id }}">{{ $destination }}</option>
            @endforeach
        </select>
        <label for="cost">أدخل تكلفة المقعد</label>
            <input
                type="number"
                name="cost"
                step="500"
                id="cost"
            >
            <input
            type="submit"
            value="إضافة"
            class="submit"
        >
    </form>
    </div>
@endsection
