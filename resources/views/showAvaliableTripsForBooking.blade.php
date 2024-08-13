@extends('main.layout')
<link href="{{asset('css/seconde.css')}}" rel="stylesheet">

@section('titleOfPage','الحافلات')

@section('title','الحافلات')

@section('logoutORback', route('showMainLayout'))

@section('buttonText', 'عودة للقائمة الرئيسية')


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

        {{-- replace 5 with the real tripID  --}}
        <a href="{{route('addManualBooking',13)}}"><li>حجز يدوي</li></a>  
@endsection
