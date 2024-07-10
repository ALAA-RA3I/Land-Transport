@extends('main.layout')
<link href="{{asset('css/seconde.css')}}" rel="stylesheet"> 

@section('titleOfPage','الحافلات')

@section('title','الحافلات')

@section('logoutORback', route('showMainLayout'))

@section('buttonText', 'عودة للقائمة الرئيسية')

@section('titleOfBox','قم بملئ معلومات الحافلة')

@section('content')
    <form action="" method="POST">
        <label for="">رقم الحافلة</label>
        <input  
            type = "number"
            name = "Bus-num"
        >
        <label for="">موديل الحافلة</label>
        <input 
            type = "text"
            name = "model"
        >
        <label for="bus-service">خدمة الحافلة</label>
        <select 
            id="bus-service" 
            name="bus_service"
        >
            <option value="normal">عادي</option>
            <option value="vip">VIP</option>
        </select>
        <label for="">رقم نمرة الحافلة </label>
        <input 
            type = "number"
            name = "nmra"
        >
        <label for="seat">نموذج المقاعد</label>
        <div class="seat-option">
            <input 
                type="radio" 
                id="seat1" 
                name="seat_model" 
                value="model1"
            >
            <label for="seat1">
                <img src="Images/photo_2024-06-30_16-50-15.jpg" alt="نموذج المقاعد 1">
                <span>نموذج المقاعد 1</span>
            </label>
            <input 
                type="radio" 
                id="seat2" 
                name="seat_model" 
                value="model2"
            >
            <label for="seat2">
                <img src="Images/photo_2024-06-30_16-50-18.jpg" alt="نموذج المقاعد 2">
                <span>نموذج المقاعد 2</span>
            </label>
        </div>
        <input 
            type="submit"
            value="إضافة"
            class="submit"
        >
    </form>
@endsection
