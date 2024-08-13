@extends('main.layout')
@include('cdn.cdn')
<link href="{{asset('css/driver/fill_driver_form.css')}}" rel="stylesheet">

@section('titleOfPage','تعديل معلومات السائق')

@section('title','السائقين')

@section('logoutORback', route('showMainLayout'))

@section('buttonText', 'عودة للقائمة الرئيسية')

@section('titleOfBox','قم بتعديل معلومات السائق')


<section class="intro" style="position: absolute ;top: 180px; right: 380px; height: 500px ;width: 1400px;
     ">
    <div>

        <div class="container " >
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="card" style="border-radius: 1rem; background-color: #f8c62d ; overflow: auto;
     max-height: 100vh;">
                        <div>
                            <img src="{{"/images/driver-logo.png"}}" style="height: 300px ; width: 300px ; position: absolute ; right: 700px; top: 180px" >
                        </div>
                        <div class="card-body p-5">

                            @if (session('success'))
                                <span class="alert alert-success "  style="width: 500px ; height: 20px; position: relative ; bottom: 20px">
                                                {{ session('success') }}
                                            </span>
                            @endif


                            <form action="{{route('updateDriver',$driver->id)}}" method="POST" >
                                @csrf
                                @method('PUT')
                                <!-- 2 column grid layout with text inputs for the first and last names -->
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="form6Example1">الأسم الأول</label>
                                            <input type="text" name="Fname" id="form6Example1" class="form-control" style=" box-shadow: 0 0 7px 3px black; " placeholder="ادخل الاسم الأول" value="{{ $driver->Fname }}"/>
                                            @if ($errors->has('Fname'))
                                                <span class="text-danger" >{{ $errors->first('Fname') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="form6Example2">الأسم الاخير</label>
                                            <input type="text"  name="Lname" id="form6Example2" class="form-control" style=" box-shadow: 0 0 7px 3px black;" placeholder="ادخل الاسم الاخير"  value="{{ $driver->Lname }}"/>
                                            @if ($errors->has('Lname'))
                                                <span class="text-danger">{{ $errors->first('Lname') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form6Example3">الأيميل</label>
                                    <input type="email" name="email" id="form6Example3" class="form-control" style=" box-shadow: 0 0 7px 3px black; width: 600px" placeholder="ادخل الايميل يجب ان يتضمن @"  value="{{ $driver->email }}" />
                                    @if ($errors->has('email'))
                                        <span class="text-danger" style="margin-bottom: -10px; position: relative;  bottom: -10px; left: 0;   font-size: 12px;" >{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="col-12 col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="form6Example1">كلمة المرور</label>
                                        <input type="password" name="password" id="form6Example4" class="form-control" style=" box-shadow: 0 0 7px 3px black; width: 600px" placeholder="ادخل كلمة المرور" value="{{ $driver->password }}"/>
                                        @if ($errors->has('password'))
                                            <span class="text-danger" >{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Number input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form6Example6">رقم الموبايل</label>
                                    <input type="number" id="form6Example6" name="phone_number" class="form-control" style=" box-shadow: 0 0 7px 3px black; width: 600px" placeholder="ادخل رقم الموبايل " value="{{ $driver->phone_number }}"  />
                                    @if ($errors->has('phone_number'))
                                        <span class="text-danger" >{{ $errors->first('phone_number') }}</span>
                                    @endif
                                </div>
                                <!-- Text input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form6Example5">سنوات الخبرة</label>
                                    <input type="tel"  name="year_experince" id="form6Example5" class="form-control" style=" box-shadow: 0 0 7px 3px black; width: 600px" placeholder="ادخل رقم يعبر عن سنوات الخبرة السابقة"value="{{ $driver->year_experince }}" />
                                    @if ($errors->has('year_experince'))
                                        <span class="text-danger" >{{ $errors->first('year_experince') }}</span>
                                    @endif
                                </div>
                                <div class="row">
                                    <!-- Text input -->
                                    <div class="col-12 col-md-6 mb-4">
                                        <label class="form-label" for="form6Example6">تاريخ الميلاد</label>
                                        <input type="date" name="birthday" id="form6Example6" class="form-control" style=" box-shadow: 0 0 7px 3px black;"  value="{{ $driver->birthday }}"/>
                                        @if ($errors->has('birthday'))
                                            <span class="text-danger" >{{ $errors->first('birthday') }}</span>
                                        @endif
                                    </div>
                                    <!-- Text input -->
                                    <div class="col-12 col-md-6 mb-4">
                                        <label class="form-label" for="form6Example6">تاريخ التوظيف</label>
                                        <input type="date" name="hire_date" id="form6Example6" class="form-control" style=" box-shadow: 0 0 7px 3px black;" value="{{ $driver->hire_date }}"  />
                                        @if ($errors->has('hire_date'))
                                            <span class="text-danger" >{{ $errors->first('hire_date') }}</span>
                                        @endif
                                    </div>

                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-secondary btn-rounded btn-block" style="position: relative ; right: 400px">تعديل معلومات الحساب</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

