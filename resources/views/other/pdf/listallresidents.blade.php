
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
        th, td {
            border: 1px solid #999;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h2>لیست اقامت‌کنندگان</h2>
    <table>
        <thead>
            <tr>
                <th>نام کامل</th>
                <th>شماره تماس</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($residents as $resident)
                <tr>
                    <td>{{ $resident->full_name }}</td>
                    <td>{{ $resident->phone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
