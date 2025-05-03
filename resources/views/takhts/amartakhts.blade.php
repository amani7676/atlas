@extends('base.base')

@section('title', 'آمار تخت ها')
@section('styles')
    <link rel="stylesheet" href="{{ asset('design/css/main2.css') }}">
@endsection

@section('body')
    <div class="container-fluid bg-gradient p-5">
        <div class="row m-auto text-center w-75">
            <div class="col-6 princing-item blue">
                <div class="pricing-divider ">
                    <h3 class="text-light">آمار کلی بر اساس طبقه ها</h3>
                    <svg class='pricing-divider-img' enable-background='new 0 0 300 100' height='100px' id='Layer_1'
                        preserveAspectRatio='none' version='1.1' viewBox='0 0 300 100' width='300px' x='0px'
                        xml:space='preserve' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns='http://www.w3.org/2000/svg'
                        y='0px'>
                        <path class='deco-layer deco-layer--1' d='M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729
                              c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z' fill='#FFFFFF' opacity='0.6'>
                        </path>
                        <path class='deco-layer deco-layer--2' d='M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729
                              c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z' fill='#FFFFFF'
                            opacity='0.6'>
                        </path>
                        <path class='deco-layer deco-layer--3' d='M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716
                              H42.401L43.415,98.342z' fill='#FFFFFF' opacity='0.7'></path>
                        <path class='deco-layer deco-layer--4' d='M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428
                              c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z'
                            fill='#FFFFFF'>
                        </path>
                    </svg>
                </div>

                <div class="card-body bg-white mt-0 shadow">
                    <table class="table table-fixed">
                        <thead>
                            <tr>
                                <th class="">طبقه</th>
                                <th class="">ظرفیت</th>
                                <th class="">پذیرش</th>
                                <th class="">رزرو</th>
                                <th class="">خالی</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['TotalPerVahed'] as $item)
                                {{-- {{dd($item)}}  --}}
                                <tr>
                                    <td>{{ $item['vahed'] }}</td>
                                    <td>{{ $item['otaghs']['total'] }}</td>
                                    <td>{{ $item['otaghs']['full'] }}</td>
                                    <td>{{ $item['otaghs']['reserve'] }}</td>
                                    <td>{{ $item['otaghs']['empty'] }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-6 princing-item red">
                <div class="pricing-divider ">
                    <h3 class="text-light">آمار کلی بر اساس تخت ها</h3>
                    <svg class='pricing-divider-img' enable-background='new 0 0 300 100' height='100px' id='Layer_1'
                        preserveAspectRatio='none' version='1.1' viewBox='0 0 300 100' width='300px' x='0px'
                        xml:space='preserve' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns='http://www.w3.org/2000/svg'
                        y='0px'>
                        <path class='deco-layer deco-layer--1' d='M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729
                              c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z' fill='#FFFFFF' opacity='0.6'>
                        </path>
                        <path class='deco-layer deco-layer--2' d='M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729
                              c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z' fill='#FFFFFF'
                            opacity='0.6'>
                        </path>
                        <path class='deco-layer deco-layer--3' d='M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716
                              H42.401L43.415,98.342z' fill='#FFFFFF' opacity='0.7'></path>
                        <path class='deco-layer deco-layer--4' d='M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428
                              c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z'
                            fill='#FFFFFF'>
                        </path>
                    </svg>
                </div>

                <div class="card-body bg-white mt-0 shadow">
                    <table class="table table-fixed">
                        <thead>
                            <tr>
                                <th class="">تخت</th>
                                <th class="">ظرفیت</th>
                                <th class="">پذیرش</th>
                                <th class="">رزرو</th>
                                <th class="">خالی</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['TotalTakhtsPerNumbers'] as $name => $item)
                                <tr>
                                    <td>{{ $name }}</td>
                                    <td>{{ $item['all'] }}</td>
                                    <td>{{ $item['full'] }}</td>
                                    <td>{{ $item['reserve'] }}</td>
                                    <td>{{ $item['empty'] }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <div class="container-fluid bg-gradient p-5">
        <div class="row m-auto text-center w-75">
            @foreach ($data['VahedPerTotalOtaghs'] as $item)
            
                <div class="col-3 princing-item {{\App\Helpers\Helper::ColorAmarTakhts($item['vahed'])}}">
                    <div class="pricing-divider">
                        <h3 class="text-light">طبقه {{$item['vahed']}}</h3>
                       
                        <svg class='pricing-divider-img' enable-background='new 0 0 300 100' height='100px' id='Layer_1'
                            preserveAspectRatio='none' version='1.1' viewBox='0 0 300 100' width='300px' x='0px'
                            xml:space='preserve' xmlns:xlink='http://www.w3.org/1999/xlink'
                            xmlns='http://www.w3.org/2000/svg' y='0px'>
                            <path class='deco-layer deco-layer--1' d='M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729
                              c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z' fill='#FFFFFF' opacity='0.6'>
                            </path>
                            <path class='deco-layer deco-layer--2' d='M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729
                              c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z' fill='#FFFFFF'
                                opacity='0.6'>
                            </path>
                            <path class='deco-layer deco-layer--3' d='M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716
                              H42.401L43.415,98.342z' fill='#FFFFFF' opacity='0.7'></path>
                            <path class='deco-layer deco-layer--4' d='M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428
                              c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z'
                                fill='#FFFFFF'>
                            </path>
                        </svg>
                    </div>
                    <div class="card-body bg-white mt-0 shadow">
                        <table class="table table-fixed">
                            <thead>
                                <tr>
                                    <th class="">تخت</th>
                                    <th class="">ظرفیت</th>
                                    <th class="">پذیرش</th>
                                    <th class="">رزرو</th>
                                    <th class="">خالی</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item['otaghs'] as $name => $otaghs)
                                    <tr>
                                        <td>{{ $name }} </td>
                                        <td>{{ $otaghs['total_takhts'] }}</td>
                                        <td>{{ $otaghs['states']['full']}}</td>
                                        <td>{{ $otaghs['states']['reserve']}}</td>
                                        <td>{{ $otaghs['states']['empty']}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            @endforeach







        </div>
    </div>
@endsection
