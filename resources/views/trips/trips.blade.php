@extends('main.layout')

@section('titleOfPage','الرحلات')

@section('title','رحلات')

@section('titleOfBox','الرحلات الحالية ')

@section('logoutORback', route('showMainLayout'))

@section('buttonText', 'عودة للقائمة الرئيسية')

@section('linkValue','إضافة رحلة استثنائية')

@section('route', route('addTripInfo'))

@section('content')
    <p>هناعرض الرحلات</p>
@endsection


@include('components.button')