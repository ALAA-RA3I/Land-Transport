@extends('main.layout')
<link href="{{asset('css/seconde.css')}}" rel="stylesheet">

@section('titleOfPage','تعديل معلومات الرحلة')

@section('title','رحلات')

@section('logoutORback', route('showMainLayout'))

@section('buttonText', 'عودة للقائمة الرئيسية')

@section('titleOfBox','قم بملئ معلومات الرحلة للتعديل')

@if ($errors->any())
    <script>
        let errorMessages = '';
        @foreach ($errors->all() as $error)
            errorMessages += '{{ $error }}\n';
        @endforeach
        alert(errorMessages);
    </script>
@endif



@section('content')
    <form action="{{ route('updateWaitTrip',$trip->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="date">أدخل تاريخ الرحلة</label>
        <input
            type="date"
            name="date"
            placeholder="تاريخ الرحلة"
            id="date"
        >
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
@endsection


