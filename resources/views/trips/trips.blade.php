@if (session('good'))
    <script>
        alert('{{ session('good') }}');
    </script>
@endif
@extends('main.layout')



@if ($errors->any())
    <script>
        let errorMessages = '';
        @foreach ($errors->all() as $error)
            errorMessages += '{{ $error }}\n';
        @endforeach
        alert(errorMessages);
    </script>
@endif

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