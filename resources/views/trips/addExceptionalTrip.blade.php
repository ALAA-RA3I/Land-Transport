@extends('main.layout')
<link href="{{asset('css/seconde.css')}}" rel="stylesheet"> 

@section('titleOfPage','إضافة رحلة استثنائية')

@section('title','رحلات')

@section('logoutORback', route('showMainLayout'))

@section('buttonText', 'عودة للقائمة الرئيسية')

@section('titleOfBox','قم بملئ معلومات الرحلة')

@section('content')
    <form action="" method="POST">
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
            name="start-trip"
            id="start-trip"
        >
        <label for="end-trip">أدخل وقت الوصول</label>
        <input 
            type="time"
            name="end-trip"
            id="end-trip"
        >
        <label for="driver">أختر السائق</label>
        <select 
            name="Driver-id" 
            id="driver"
        >
        </select>
        <label for="bus">اختر الحافلة</label>
        <select 
            name="Bus-id" 
            id="bus"
        >
        </select>
        <label for="from-to">اختر الوجهة</label>
        <select 
            name="From-To-id" 
            id="from-to"
        >
        </select>
        <label for="cost">أدخل تكلفة المقعد</label>
            <input 
                type="number"
                name="cost"
                id="cost"
            >
    </form>
@endsection


