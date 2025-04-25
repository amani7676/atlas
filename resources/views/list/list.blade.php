@extends('base.base')

@section('title', 'لیست')

@section('body')
    @foreach ($data as $vaheds)
        <div class="card m-3 text-center">
            <div class="card-header bg-secondary">
                {{ $vaheds['vahed_name'] }}
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($vaheds['otaghs'] as $otaghs)
                        <div class="col-md-6">
                            <div class="custom-card card mb-3">
                                <div class="card-header bg-secondary">
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
