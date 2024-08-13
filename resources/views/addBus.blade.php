@extends('main.layout')
<link href="{{asset('css/seconde.css')}}" rel="stylesheet">

@section('titleOfPage','الحافلات')

@section('title','الحافلات')

@section('logoutORback', route('showMainLayout'))

@section('buttonText', 'عودة للقائمة الرئيسية')

@section('titleOfBox','قم بملئ معلومات الحافلة')

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
    <form action=" {{route('recieveBusInfo')}} " method="POST">
        @csrf
        <label for="bus_name">اسم الحافلة</label>
        <input
            type = "text"
            name = "bus_name"
            id="bus_name"
        >
        <label for="model">موديل الحافلة</label>
        <input
            type = "text"
            name = "model"
            id="model"
        >
        <label for="bus-service">خدمة الحافلة</label>
        <select
            id="bus-service"
            name="type"
        >
            <option value="عادي">عادي</option>
            <option value="VIP">VIP</option>
        </select>

        <label for="bus_number">رقم الحافلة </label>
        <input
            type = "number"
            name = "bus_number"
            id="bus_number"
        >
        <label for="seat">نموذج المقاعد</label>
        <div class="seat-option">
            <input
                type="radio"
                id="seat1"
                name="form_type"
                value="A"
            >
            <label for="seat1">
                <img src="{{asset('Images/photo_2024-06-30_16-50-15.jpg')}}" alt="نموذج المقاعد 1">
                <span>نموذج المقاعد 1</span>
            </label>
            <input
                type="radio"
                id="seat2"
                name="form_type"
                value="B"
            >
            <label for="seat2">
                <img src="{{asset('Images/photo_2024-06-30_16-50-18.jpg')}}" alt="نموذج المقاعد 2">
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
