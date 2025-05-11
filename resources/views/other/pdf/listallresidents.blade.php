<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: "vazir", sans-serif;
            direction: rtl;
            text-align: right;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 8px;
        }
    </style>
</head>

<body class="text-center">
    <div class="header">
        <h1>گزارش اقامتگران</h1>
        <p>تاریخ: {{ jdate()->format('Y/m/d') }}</p>
    </div>
    <h2>لیست اقامت‌کنندگان</h2>
    <table>
        <thead>
            <tr>
                <th>نام کامل</th>
                <th>شماره تماس</th>
                <th>تاریخ سررسید</th>
                <th>شماره تخت</th>
                <th>شماره اتاق</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($data as $vahed)
                @foreach ($vahed['otaghs'] as $otaghs)
                    @foreach ($otaghs['takhts'] as $takhts)
                        @if (!is_null($takhts['resident']))
                            <tr>
                                <td>{{ $takhts['resident']['full_name'] }}</td>
                                <td>{{ $takhts['resident']['end_date'] }}</td>
                                <td>{{ $takhts['resident']['phone'] }}</td>
                                <td>{{ explode('_', $takhts['takht_name'])[1] }}</td>
                                <td>{{ $otaghs['otagh_name'] }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="3" class="text-center">اتاق خالی میباشد</td>
                                <td>{{ explode('_', $takhts['takht_name'])[1] }}</td>
                                <td>{{ $otaghs['otagh_name'] }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>

</html>
