@extends('main.layout')
@include('cdn.JQuery')
@include('cdn.cdn')

<link href="{{asset('css/scheduled.css')}}" rel="stylesheet">

@section('titleOfPage','جدولة الرحلات')


@component('components.button')
    @section('linkValue', 'إضافة جدولة رحلات')
    @section('route', route('showScheduledForm'))
@endcomponent


@section('logoutORback', route('showMainLayout'))

@section('buttonText', 'عودة للقائمة الرئيسية')


@section('title','رحلات')
@section('titleOfBox','استعراض أيام الجدولة')



<div class="all">
    <div class="allDivs" style="display: flex; flex-wrap: wrap; justify-content: space-evenly; margin-top:30px">
        <a href="{{route('showSaturdayTrip','saturday')}}" style="width: 40%; margin-bottom: 20px; text-decoration: none; color: inherit;">
            <div class="card text-bg-primary" style="width: 100%; border-radius: 5px; border-color: blanchedalmond;">
                <div class="card-header" style="background-color:#e1ad21; color:#2d3748; font-weight: bolder">السبت</div>
                <div class="card-body" style="background-color:#f8c62d; color:#2d3748; font-weight: bolder">
                    <h5 class="card-title" style="font-size: x-large">تفاصيل رحلات السبت</h5>
                    <span style="font-size: x-small">انقر لرؤية التفاصيل</span>
                </div>
            </div>
        </a>
    
        <a href="{{route('showSundayTrip' , 'sunday')}}" style="width: 40%; margin-bottom: 20px;text-decoration: none; color: inherit;">
            <div class="card text-bg-primary" style="width: 100%; border-radius: 5px; border-color: blanchedalmond;">
                <div class="card-header" style="background-color:#e1ad21; color:#2d3748; font-weight: bolder">الاحد</div>
                <div class="card-body" style="background-color:#f8c62d; color:#2d3748; font-weight: bolder">
                    <h5 class="card-title" style="font-size: x-large">تفاصيل رحلات يوم الاحد</h5>
                    <span style="font-size: x-small">انقر لرؤية التفاصيل</span>
                </div>
            </div>
        </a>
    
        <a href="{{route('showMondayTrip' , 'monday')}}" style="width: 40%; margin-bottom: 20px; text-decoration: none; color: inherit;">
            <div class="card text-bg-primary" style="width: 100%; border-radius: 5px; border-color: blanchedalmond;">
                <div class="card-header" style="background-color:#e1ad21; color:#2d3748; font-weight: bolder">الاثنين</div>
                <div class="card-body" style="background-color:#f8c62d; color:#2d3748; font-weight: bolder">
                    <h5 class="card-title" style="font-size: x-large">تفاصيل رحلات يوم الاثنين</h5>
                    <span style="font-size: x-small">انقر لرؤية التفاصيل</span>
                </div>
            </div>
        </a>
    
        <a href="{{route('showThesdayTrip' , 'thesday')}}" style="width: 40%; margin-bottom: 20px; text-decoration: none; color: inherit;">
            <div class="card text-bg-primary" style="width: 100%; border-radius: 5px; border-color: blanchedalmond;">
                <div class="card-header" style="background-color:#e1ad21; color:#2d3748; font-weight: bolder">الثلاثاء</div>
                <div class="card-body" style="background-color:#f8c62d; color:#2d3748; font-weight: bolder">
                    <h5 class="card-title" style="font-size: x-large">تفاصيل رحلات يوم الثلاثاء</h5>
                    <span style="font-size: x-small">انقر لرؤية التفاصيل</span>
                </div>
            </div>
        </a>
    
        <a href="{{route('showWednesdayTrip' , 'wednesday')}}" style="width: 40%; margin-bottom: 20px; text-decoration: none; color: inherit;">
            <div class="card text-bg-primary" style="width: 100%; border-radius: 5px; border-color: blanchedalmond;">
                <div class="card-header" style="background-color:#e1ad21; color:#2d3748; font-weight: bolder">الاربعاء</div>
                <div class="card-body" style="background-color:#f8c62d; color:#2d3748; font-weight: bolder">
                    <h5 class="card-title" style="font-size: x-large">تفاصيل رحلات يوم الاربعاء</h5>
                    <span style="font-size: x-small">انقر لرؤية التفاصيل</span>
                </div>
            </div>
        </a>

        <a href="{{route('showThursdayTrip' , 'thursday')}}" style="width: 40%; margin-bottom: 20px; text-decoration: none; color: inherit;">
            <div class="card text-bg-primary" style="width: 100%; border-radius: 5px; border-color: blanchedalmond;">
                <div class="card-header" style="background-color:#e1ad21; color:#2d3748; font-weight: bolder">الخميس</div>
                <div class="card-body" style="background-color:#f8c62d; color:#2d3748; font-weight: bolder">
                    <h5 class="card-title" style="font-size: x-large">تفاصيل رحلات يوم الخميس</h5>
                    <span style="font-size: x-small">انقر لرؤية التفاصيل</span>
                </div>
            </div>
        </a>

        <a href="{{route('showFridayTrip' , 'friday')}}" style="width: 40%; margin-bottom: 20px; text-decoration: none; color: inherit;">
            <div class="card text-bg-primary" style="width: 100%; border-radius: 5px; border-color: blanchedalmond;">
                <div class="card-header" style="background-color:#e1ad21; color:#2d3748; font-weight: bolder">الجمعة</div>
                <div class="card-body" style="background-color:#f8c62d; color:#2d3748; font-weight: bolder">
                    <h5 class="card-title" style="font-size: x-large">تفاصيل رحلات يوم الجمعة</h5>
                    <span style="font-size: x-small">انقر لرؤية التفاصيل</span>
                </div>
            </div>
        </a>
    </div>
    </div>
</div>

<div class="container">
    <label class="switch">
        <input type="checkbox" id="toggle-switch">
        <span class="slider round"></span>
        <span>التحكم بحالةالرحلات</span>
        <span id="toggle-label">إيقاف</span> <!-- النص الذي يعكس الحالة -->
    </label>
</div>
<input type="hidden" id="status-value" name="status-value" value="0">

<script>
// عند تحميل الصفحة، تحقق من الحالة المخزنة في localStorage
window.onload = function() {
    const toggleSwitch = document.getElementById("toggle-switch");
    const label = document.getElementById("toggle-label");
    const statusValue = document.getElementById("status-value");

    // استرجاع الحالة من localStorage
    const savedState = localStorage.getItem("toggleState");

    if (savedState === "1") {
        toggleSwitch.checked = true;
        label.textContent = "تشغيل";
        statusValue.value = "1";
    } else {
        toggleSwitch.checked = false;
        label.textContent = "إيقاف";
        statusValue.value = "0";
    }
};
// تحديث الحالة وحفظها في localStorage عند تغيير حالة الزر
document.getElementById("toggle-switch").addEventListener("change", function() {
    const label = document.getElementById("toggle-label");
    const statusValue = document.getElementById("status-value");
    
    if (this.checked) {
        label.textContent = "تشغيل";
        statusValue.value = "1";
        localStorage.setItem("toggleState", "1");  // حفظ الحالة في localStorage
    } else {
        label.textContent = "إيقاف";
        statusValue.value = "0";
        localStorage.setItem("toggleState", "0");  // حفظ الحالة في localStorage
    }
});
</script>