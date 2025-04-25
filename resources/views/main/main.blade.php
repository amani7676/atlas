@extends('base.base')

@section('body')

<div class="container py-5">
    <!-- ردیف اول -->
    <div class="row">
        <div class="col-md-6">
            @include('main.partials.sar')
        </div>
        <div class="col-md-6">
           @include('main.partials.bedehy')
        </div>
    </div>

    <!-- ردیف دوم -->
    <div class="row">
        <div class="col-md-6">
            @include('main.partials.khoroje')
        </div>
        <div class="col-md-6">
            @include('main.partials.khali')
            </div>
        </div>
    </div>

    <!-- ردیف سوم -->
    <div class="row">
        <div class="col-4">
           @include('main.partials.madarek')
        </div>
        <div class="col-4">
            @include('main.partials.form')
        </div>
        <div class="col-4">
            @include('main.partials.tozihat')
        </div>
    </div>
</div>
    {{-- <div class="container ">
        <!-- ردیف اول -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">هدر اول</div>
                    <div class="card-body">
                        محتوای کادر اول ردیف اول
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">هدر دوم</div>
                    <div class="card-body">
                        محتوای کادر دوم ردیف اول
                    </div>
                </div>
            </div>
        </div>

        <!-- ردیف دوم -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">هدر سوم</div>
                    <div class="card-body">
                        محتوای کادر اول ردیف دوم
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">هدر چهارم</div>
                    <div class="card-body">
                        محتوای کادر دوم ردیف دوم
                    </div>
                </div>
            </div>
        </div>

        <!-- ردیف سوم -->
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">هدر چهارم</div>
                    <div class="card-body">
                        محتوای کادر دوم ردیف دوم
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">هدر چهارم</div>
                    <div class="card-body">
                        محتوای کادر دوم ردیف دوم
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">هدر چهارم</div>
                    <div class="card-body">
                        محتوای کادر دوم ردیف دوم
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
