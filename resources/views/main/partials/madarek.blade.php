<div class="custom-card card text-center ">
    <div class="card-header">مدارک</div>
    <div class="card-body">
        <div class="table-responsive custom-table ">
            <table class="table  table-hover">
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
                        @if (isset($resident['madrak']) && $resident['madrak'] == '0')
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
                                    <a href="{{route('change_madrak_form', ['name'=>'madrak','id'=> $resident['resident_id']])}}" class="text-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                                            <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
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
