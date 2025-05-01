<div class="custom-card card text-center">
    <div class="card-header">فرم</div>
    <div class="card-body">
        <div class="table-responsive custom-table">
            <table class="table  table-hover ">
                <thead class="align-middle  table-secondary">
                    <tr>
                        <th>اتاق</th>
                        <th>نام</th>
                        <th>تلفن</th>
                        <th>سررسید</th>
                        <th>توضیحات</th>
                        <th>تغییر</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($residents as $resident)
                        @php
                            $bedheyDescriptions = [];
                            foreach ($resident['descriptions'] as $description) {
                                if ($description['type'] == 'other') {
                                    $bedheyDescriptions[] = $description['desc'];
                                }
                            }
                        @endphp
                        @if (isset($resident['form']) && $resident['form'] == '0')
                            <tr>
                                <td>{{ $resident['otagh_name'] }}</td>
                                <td>{{ $resident['full_name'] }}</td>
                                <td>{{ $resident['phone'] }}</td>
                                <td>{{ $resident['end_date'] }}</td>
                                <td>
                                    @foreach ($bedheyDescriptions as $desc)
                                        <span
                                            style="display: inline-block; background: #eef; padding: 4px 8px; margin: 2px; border-radius: 6px;">
                                            {{ $desc }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="#" class="text-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                            fill="currentColor" class="bi bi-credit-card-2-front-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z" />
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
