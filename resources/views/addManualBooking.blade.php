@extends('main.layout')
<link href="{{asset('css/seconde.css')}}" rel="stylesheet">

@section('titleOfPage','حجز يدوي')

@section('title','جدز يدوي')

@section('logoutORback', route('showMainLayout'))

@section('buttonText', 'عودة للقائمة الرئيسية')
@section('titleOfBox','قم بملئ معلومات الحجز ')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    </div>
@endif

<form action="{{ route('addBooking') }}" method="POST">
    @csrf
    <label for="firstName">الاسم الأول</label>
    <input type="text" name="firstName"  id="firstName" value="{{ old('firstName') }}">

    <label for="middleName">الاسم الأوسط</label>
    <input type="text" name="middleName"  id="middleName" value="{{ old('middleName') }}">

    <label for="lastName">الاسم الأخير</label>
    <input type="text" name="lastName"  id="lastName" value="{{ old('lastName') }}">

    <label for="nationalId">الرقم الوطني</label>
    <input type="number" name="nationalId"  id="nationalId" value="{{ old('nationalId') }}">

    <label for="phoneNumber">رقم الجوال</label>
    <input type="number" name="phoneNumber"  id="phoneNumber" value="{{ old('phoneNumber') }}">

    <label for="seatNumber">رقم المقعد</label>
    <select name="seatNumber" id="seatNumber">
        @for ($i = 1; $i <= 10; $i++) 
            <option value="{{ $i }}" {{ old('seatNumber') == $i ? 'selected' : '' }}>مقعد {{ $i }}</option>
        @endfor
    </select>

    <button type="submit" class="submit">حجز</button>
</form>
@endsection
