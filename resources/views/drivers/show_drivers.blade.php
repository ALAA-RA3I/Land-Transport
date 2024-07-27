

@extends('main.layout')

@section('titleOfPage','السائقين')

@section('title','السائقين')

@section('logoutORback', route('showMainLayout'))

@section('buttonText', 'عودة للقائمة الرئيسية')

@section('titleOfBox','سائقين الفرع ')

@section('linkValue','إنشاء حساب سائق جديد')

@section('route', route('addDriver'))


@if (session('success'))
    <script>
        alert('{{ session('success') }}');
    </script>
@endif

@section('content')
    <p>هنا عرض السائقين</p>
@endsection


@include('components.button')
