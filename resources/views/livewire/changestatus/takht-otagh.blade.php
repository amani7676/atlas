    <div class="container">
        @if (session()->has('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif
        <div class="row">
            <div class="col-6">
                <label for="" class="form-label">اقامتگر</label>
                <select wire:change="handleSelectChange($event.target.value)" id="resident-select" class="form-control">
                    <option value="">انتخاب کنید...</option>
                    @foreach ($residents as $resident)

                        <option value="{{ $resident->id }}">{{ $resident ->otagh_name }}__{{ $resident->full_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <div class="card mt-4 text-center">
                    <div class="card-header">
                        مشخصات کاربر
                    </div>
                    <div class="card-body">
                        @if ($residentDetails)
                            <div class="row">
                                <div class="col-3">
                                    <p class="h6"><span class="font-">نام:</span> {{ $residentDetails['full_name'] }}</p>
                                    <p class="h6"><span class="font-">شماره تخت</span> {{ $residentDetails['takht_name'] }}
                                    </p>
                                </div>
                                <div class="col-3">
                                    <p class="h6"><span class="font-">اتاق:</span> {{ $residentDetails['otagh_name'] }}</p>
                                    <p class="h6"><span class="font-">اتاق:</span> {{ $residentDetails['takht_name'] }}</p>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>


            {{--     --}}

            <div class="col-6 mt-4">
                <label for="" class="form-label">اتاق</label>
                <select wire:change="handleSelectChangeTakht($event.target.value)" id="takht-select"
                    class="form-control">
                    <option value="">انتخاب کنید...</option>
                    @foreach ($takhts as $takht)

                        <option value="{{ $takht['id'] }}" class="{{ $takht['resident'] ? '' : 'bg-warning fw-bold' }}">{{ $takht['resident']['full_name'] ?? 'خالی' }}__{{ $takht['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6">
                <div class="card mt-4 text-center">
                    <div class="card-header">
                        مشخصات اتاق
                    </div>
                    <div class="card-body">
                        @if ($takhtDetails)
                            {{-- {{ dd($takhtDetails->state) }} --}}
                            <div class="row">
                                <div class="col-3">
                                    <p class="h6"><span class="font-">اتاق:</span> {{ $takhtDetails->otagh->name }}</p>
                                    <p class="h6"><span class="font-">شماره تخت</span> {{ $takhtDetails->name }}</p>
                                </div>
                                @if ($takhtDetails->state == 'reserve' || $takhtDetails->state == 'full')
                                    <div class="col-3">
                                        <p class="h6"><span class="font-">نام: {{ $takhtDetails->resident->full_name }}</span>
                                        </p>
                                        <p class="h6"><span class="font-">اتاق:</span> </p>
                                    </div>
                                @else
                                    <div class="col-3">
                                        <p><span class="font-">نام: خالی</span>
                                        </p>
                                    </div>
                                @endif


                            </div>

                        @endif

                    </div>
                </div>
            </div>

            <div class="col-5 mt-5">
                <button wire:click="storeResidentInfo" class="btn btn-success">
                    جابجایی شود
                </button>
            </div>
        </div>




        @push('scripts')
            <script>
                $(document).ready(function() {});

                $(document).ready(function() {

                });
            </script>
        @endpush

    </div>
