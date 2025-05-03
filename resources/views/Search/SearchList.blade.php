@extends('base.base')

@section('title', 'سرچ کردن ')

@section('styles')
    <style>
        .message {
            font-size: 24px;
            color: #333;
            background-color: #fff;
            padding: 20px 40px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            top: 50%
        }
    </style>
@endsection
@section('body')
    {{-- <div class="p-4 bg-gray-100 rounded mb-4 d-flex flex-row">
    <form id="filter-form" class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <!-- متن -->
        <div>
            <label class="block text-sm font-medium">نام کامل</label>
            <input type="text" name="full_name" class="mt-1 block w-full border rounded px-2 py-1" placeholder="جستجوی نام">
        </div>

        <div>
            <label class="block text-sm font-medium">تلفن</label>
            <input type="text" name="phone" class="mt-1 block w-full border rounded px-2 py-1" placeholder="شماره تلفن">
        </div>

        <div>
            <label class="block text-sm font-medium">پایان قرارداد</label>
            <input type="date" name="end_date" class="mt-1 block w-full border rounded px-2 py-1">
        </div>

        <!-- عدد -->
        <div>
            <label class="block text-sm font-medium">سن</label>
            <input type="number" name="age" class="mt-1 block w-full border rounded px-2 py-1" placeholder="سن">
        </div>

        <!-- لیست کشویی -->
        <div>
            <label class="block text-sm font-medium">شغل</label>
            <select name="job" class="mt-1 block w-full border rounded px-2 py-1">
                <option value="">همه</option>
                <option value="karmand_dolat">کارمند دولت</option>
                <option value="karmand_shkhse">کارمند شخصی</option>
                <option value="daneshjo_azad">دانشجوی آزاد</option>
                <option value="danshjo_dolati">دانشجوی دولتی</option>
                <option value="danshjo_sair">دانشجوی سایر</option>
                <option value="sair">سایر</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">وضعیت</label>
            <select name="state" class="mt-1 block w-full border rounded px-2 py-1">
                <option value="">همه</option>
                <option value="active">Active</option>
                <option value="reserve">Reserve</option>
                <option value="leaving">Leaving</option>
                <option value="exit">Exit</option>
            </select>
        </div>

        <!-- چک‌باکس‌ها -->
        <div class="col-span-1 md:col-span-3 flex flex-wrap gap-4">
            <label><input type="checkbox" name="vadeh" value="1"> وعده</label>
            <label><input type="checkbox" name="ejareh" value="1"> اجاره</label>
            <label><input type="checkbox" name="madrak" value="1"> مدرک</label>
            <label><input type="checkbox" name="form" value="1"> فرم</label>
            <label><input type="checkbox" name="bedehy" value="1"> بدهی</label>
            <label><input type="checkbox" name="takhir" value="1"> تأخیر</label>
        </div>

    </form>
</div> --}}

    <div class="message text-center">
        صفحه در حال ساخت است
    </div>

    <div id="resident-list" class="space-y-3">
        {{-- نتایج اینجا لود می‌شن --}}
    </div>
@endsection
