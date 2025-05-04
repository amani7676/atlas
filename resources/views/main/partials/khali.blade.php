<div class="custom-card card text-center">
    <div class="card-header">خالی ها</div>
    <div class="card-body">
        <div class="table-responsive custom-table">
            <table class="table  table-hover ">
                <thead class="align-middle  table-secondary">
                    <tr>
                        <th>اتاق</th>
                        <th>شماره تخت</th>
                        <th></th>
                        <th >َاضافه کردن</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @php
                        $counter = 0;
                    @endphp
                    @foreach ($data as $vaheds)
                        @foreach ($vaheds['otaghs'] as $otaghs)
                            @foreach ($otaghs['takhts'] as $takhts)
                                @if ($takhts['state'] == 'empty' && $counter < 15)
                                    <tr>
                                        <td>{{$otaghs['otagh_name']}}</td>
                                        <td>{{explode('_', $takhts['takht_name'])[1]}}</td>
                                        <td colspan="3">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#addResidentTarget" data-takht_id="{{$takhts['takht_name']}}" data-otagh_id={{$otaghs['otagh_name']}}>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                                                  </svg>
                                            </a>
                                        </td>
                                    </tr>
                                    @php
                                        $counter++;
                                    @endphp
                                @endif
                            @endforeach
                        @endforeach
                    @endforeach
                   
                </tbody>
            </table>
            @if ($counter >= 10)
            <h5 class="bg-danger p-2">بیشتر از 15 تا خالی نمایش داده نمیشود</h5>
        @endif
        </div>
    </div>
</div>