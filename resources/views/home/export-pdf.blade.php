<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Aktivitas</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Laporan Aktivitas Pengguna</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Aktivitas</th>
                <th>User</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aktivitas as $index => $data)

            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $data->aktivitas }}</td>
                <td>{{ $data->username }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
