@extends('main.layout')

<link href="{{asset('css/seconde.css')}}" rel="stylesheet"> 


@section('titleOfPage',' إضافة معلومات جدولة الرحلات')

@section('logoutORback', route('showMainLayout'))

@section('buttonText', 'عودة للقائمة الرئيسية')


@section('content')
    <div class="all">
        <form action="{{ route('ScheduledInfo') }}" method="POST">
        @csrf
        <label for="day">أختر يوماً</label>
        <select name="day_name" id="">
            <option value="sunday">الأحد</option>
            <option value="monday">الأثنين</option>
            <option value="thesday">الثلاثاء</option>
            <option value="wednesday">الأربعاء</option>
            <option value="thursday">الخميس</option>
            <option value="friday">الجمعة</option>
            <option value="saturday">السبت</option>
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
