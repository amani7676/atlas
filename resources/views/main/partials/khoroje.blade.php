<div class="custom-card card text-center">
    <div class="card-header">خروجی ها</div>
    <div class="card-body">
        <div class="table-responsive custom-table">
            <table class="table  table-hover ">
                <thead class="align-middle  table-secondary">
                    <tr>
                        <th>اتاق</th>
                        <th>نام</th>
                        <th>تلفن</th>
                        <th>سررسید</th>
                        <th>مانده</th>
                        <th>توضیحات</th>
                        <th>لینک</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    
                    @foreach ($residents as $resident)
                        @php
                            $bedheyDescriptions = [];
                            foreach ($resident['descriptions'] as $description) {
                                if ($description['type'] == 'khoroj') {
                                    $bedheyDescriptions[] = $description['desc'];
                                }
                            }

                        @endphp
                        @if (isset($resident['state']) && $resident['state'] == "leaving")
                            <tr>
                                <td>{{ $resident['otagh_name'] }}</td>
                                <td>{{ $resident['full_name'] }}</td>
                                <td>{{ $resident['phone'] }}</td>
                                <td>{{ $resident['end_date'] }}</td>
                                <td>
                                    <span
                                        class="badge text-bg-{{\App\Helpers\Helper::getSarrsedStatus($resident['sarrsed'])}}">{{ $resident['sarrsed'] }}
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
                                <td>
                                    <a href="{{ route('list') }}#{{ $resident['otagh_name'] }}" class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
