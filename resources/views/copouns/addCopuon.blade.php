@extends('main.layout')
<link href="{{asset('css/seconde.css')}}" rel="stylesheet">

@section('titleOfPage',' اضافة كوبون')

@section('title','اضافة كوبون')

@section('logoutORback', route('showMainLayout'))

@section('buttonText', 'عودة للقائمة الرئيسية')
@section('titleOfBox','إضافة كوبون')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    </div>
@endif
@if (session('fail'))
    <div class="alert alert-erroe">
        {{ session('fail') }}
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

<form action="{{ route('coupons.create') }}" method="POST">
    @csrf   
    <label for="name">اسم الكوبون</label>
    <input type="text" name="name"  id="name" value="{{ old('name') }}">

    <label for="num_chair"> عدد الكراسي</label>
    <input type="number" name="num_chair"  id="num_chair" value="{{ old('num_chair') }}">

    <label for="free_chair"> عدد الكراسي المجانية</label>
    <input type="number" name="free_chair"  id="free_chair" value="{{ old('free_chair') }}">


    <button type="submit" class="submit">اضافة</button>
</form>
@endsection
