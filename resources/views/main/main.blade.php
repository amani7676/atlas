@extends('base.base')

@section('body')
    <div class="p-4 ">
        <!-- ردیف اول -->
        <div class="row">
            <div class="col-md-7">
                @include('main.partials.sar')
            </div>
            <div class="col-md-5">
                
                @include('main.partials.rezerve')
            </div>
        </div>

        <!-- ردیف دوم -->
        <div class="row">
            <div class="col-md-7">
                @include('main.partials.khoroje')
            </div>
            <div class="col-md-5">
                @include('main.partials.khali')
            </div>
        </div>


        <!-- ردیف سوم -->
        <div class="row ">
            <div class="col-md-4">
                @include('main.partials.madarek')
            </div>
            <div class="col-md-4">
                @include('main.partials.form')
            </div>
            <div class="col-md-4">
                {{-- @include('main.partials.tozihat') --}}
                @include('main.partials.bedehy')
            </div>
        </div>

    </div>
@endsection
