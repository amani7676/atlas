@extends('base.base')

@section('title', 'لیست')


@section('body')
    @foreach ($data as $vaheds)
        <div class="card m-3 text-center">
            <div class="card-header " id="header_vahed_{{$vaheds['vahed_id']}}">
                {{ $vaheds['vahed_name'] }}
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($vaheds['otaghs'] as $otaghs)
                        <div class="col-md-6">
                            <div class="custom-card card mb-3 text-center" id={{$otaghs['otagh_name']}}>
                                <div class="card-header " id="header_otagh_{{$vaheds['vahed_id']}}">
                                    {{ $otaghs['otagh_name'] }}
                                </div>
                                <div class="card-body">
                                    @include('list.partials.table')
                                </div>
                            </div>
                        </div>
                        
                    @endforeach
                </div>


            </div>
        </div>
    @endforeach

@endsection

@section('footer')


@endsection
@include('list.components.modal-desc')
@include('list.components.update-collapse')
@include('list.components.js.update-all-js')
@include('list.components.js.updateQuick')
@include('list.components.js.modal-desc-js')
