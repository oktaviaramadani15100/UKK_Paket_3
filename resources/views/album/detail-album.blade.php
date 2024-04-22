<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container-detail {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
        }

        .card-detail {
            display: flex;
            width: 80%;
            max-width: 800px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .card-detail .image {
            flex: 1;
            background-color: #ddd;
        }

        .card-detail img {
            width: 100%;
            height: auto;
            border-radius: 12px 0 0 12px;
            object-fit: cover;
        }

        .card-detail .details {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
            background-color: #fff;
        }

        .details h1 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .details h2 {
            font-size: 25px;
            font-weight: bold;
            color: #555;
            margin-bottom: 10px;
        }

        .details p {
            font-size: 16px;
            color: #666;
            margin-top: 0;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            width: 200px;
            height: 200px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .card:hover img {
            transform: scale(1.1);
        }

        .logo-back {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            background-color: #ffffff;
            margin-top: 20px;
            margin-left: 20px;
            text-decoration: none;
        }

        .logo-back:hover {
            background-color: #a8a6a6;
        }

        .logo-back a {
            color: inherit;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <a class="logo-back" href="{{ route('profile', ['username' => Auth::user()->username]) }}">
        <i class="fas fa-arrow-left"></i>
    </a>

    <div class="container-detail">
        <div class="card-detail">
            <div class="image">
                <img src="{{ asset('upload/' . $album->foto) }}" alt="">
            </div>
            <div class="details">
                <h1>Uploaded by: {{ $album->user->nama_lengkap }}</h1>
                <h2>{{ $album->NamaAlbum }}</h2>
                <p>{{ $album->Deskripsi }}</p>
                <p>{{ $album->TanggalDibuat }}</p>
            </div>
        </div>

        <div class="card-container">
            @foreach ($fotos as $foto)
                <div class="card">
                    <img src="{{ asset('upload/' . $foto->LokasiFIle) }}" alt="">
                </div>
            @endforeach
        </div>
    </div>

</body>

</html>
