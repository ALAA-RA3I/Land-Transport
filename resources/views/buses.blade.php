@extends('main.layout')

@section('titleOfPage','الحافلات')

@section('title','السائقين')

@section('logoutORback', route('showMainLayout'))

@section('buttonText', 'عودة للقائمة الرئيسية')

@section('titleOfBox','الحافلات المتوفرة ')

@section('linkValue','إضافة حافلة جديدة')

@section('route', route('busInfo'))


@if (session('success'))
    <script>
        alert('{{ session('success') }}');
    </script>
@endif

@section('content')
    <p>هنا عرض الحافلات</p>
@endsection

@include('components.button')
