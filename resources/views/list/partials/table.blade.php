<table class="table table-hover">
    <thead class="table-secondary">
        <tr>
            <th>تخت</th>
            <th>نام</th>
            <th>تلفن</th>
            <th>تاریخ سررسید</th>
            <th>مانده تا سررسید</th>
            <th>توضیحات</th>
            <th>ویرایش</th>
        </tr>
    </thead>
    <tbody class="align-middle">

        @foreach ($otaghs['takhts'] as $takhts)
            @php
                $bedheyDescriptions = [];

                if (!empty($takhts['resident']['descriptions'])) {
                    foreach ($takhts['resident']['descriptions'] as $description) {
                        $bedheyDescriptions[] = $description['desc'];
                    }
                }
            @endphp
            @if ($takhts['resident'] == null)
                <tr>
                    <td>{{ substr($takhts['takht_name'], -1) }}</td>
                    <td colspan="3"></td>
                    <td colspan="3">
                        <a href="" data-bs-toggle="modal" data-bs-target="#addResidentTarget"
                            data-takht_id="{{ $takhts['takht_name'] }}" data-otagh_id={{ $otaghs['otagh_name'] }}>
                            <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor"
                                class="bi bi-person-fill-add" viewBox="0 0 16 16">
                                <path
                                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path
                                    d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                            </svg>
                        </a>
                    </td>
                </tr>
            @else
               
                <tr data-resident-id="{{ $takhts['resident']['resident_id'] }}"
                 id="{{ isset($takhts['resident']['info']['state']) ? \App\Helpers\Helper::ColorStateTd($takhts['resident']['info']['state']) : '' }}"
                 
                >
                    <td id="takht_name" >
                        {{ substr($takhts['takht_name'], -1) }}
                    </td> 
                    <td>
                        <input type="text" name="full_name" class="form-control"
                            value="{{ $takhts['resident']['full_name'] }}">
                    </td>
                    <td>
                        <input type="text" name="phone" class="form-control"
                            value="{{ $takhts['resident']['phone'] }}">
                    </td>
                    <td>
                        <input type="text" name="end_date" class="form-control"
                            value="{{ $takhts['resident']['end_date'] }}">
                    </td>

                    <td>
                        <span style="font-size: 13px" id="showSar"
                            class="badge text-bg-{{ \App\Helpers\Helper::getSarrsedStatus($takhts['resident']['sarrsed']) }}">{{ $takhts['resident']['sarrsed'] }}
                        </span>
                    </td>
                    <td>
                        @foreach ($bedheyDescriptions as $desc)
                            <span
                                style="display: inline-block; background: #eef; padding: 4px 8px; margin: 2px; border-radius: 6px;">
                                {{ $desc }}
                            </span>
                        @endforeach
                    </td>
                    <td class="p-4" style="width: 17%">
                        <div class="" style="margin-right: 8px; display: inline-block;"> <a href="#"
                                class="m-1 save-resident">
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27"
                                    fill="currentColor" class="bi bi-play-fill text-success" viewBox="0 0 16 16">
                                    <path
                                        d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393" />
                                </svg>
                            </a></div>
                        <div class=""style="margin-right: 8px; display: inline-block;"><a href="#"
                                class="m-1" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop"
                                aria-controls="staticBackdrop">
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27"
                                    fill="currentColor" class="bi bi-pencil-square text-info" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                </svg>
                            </a></div>
                        <div class=""style="margin-left: 5px; display: inline-block;"><a href="#"
                                class="m-1" id="modalDesc" data-bs-toggle="offcanvas" data-bs-target="#modalDesc"
                                aria-controls="modalDesc">
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27"
                                    fill="currentColor" class="bi bi-brush-fill text-primary" viewBox="0 0 16 16">
                                    <path
                                        d="M15.825.12a.5.5 0 0 1 .132.584c-1.53 3.43-4.743 8.17-7.095 10.64a6.1 6.1 0 0 1-2.373 1.534c-.018.227-.06.538-.16.868-.201.659-.667 1.479-1.708 1.74a8.1 8.1 0 0 1-3.078.132 4 4 0 0 1-.562-.135 1.4 1.4 0 0 1-.466-.247.7.7 0 0 1-.204-.288.62.62 0 0 1 .004-.443c.095-.245.316-.38.461-.452.394-.197.625-.453.867-.826.095-.144.184-.297.287-.472l.117-.198c.151-.255.326-.54.546-.848.528-.739 1.201-.925 1.746-.896q.19.012.348.048c.062-.172.142-.38.238-.608.261-.619.658-1.419 1.187-2.069 2.176-2.67 6.18-6.206 9.117-8.104a.5.5 0 0 1 .596.04" />
                                </svg>
                            </a></div>
                    </td>
                </tr>
            @endif
        @endforeach

    </tbody>
</table>
