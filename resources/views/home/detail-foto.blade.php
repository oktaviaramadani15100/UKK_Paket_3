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
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
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

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-detail {
            display: flex;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .card-detail .image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-detail img {
            max-width: 100%;
            height: auto;
            border-radius: 10px 0 0 10px;
        }

        .details {
            flex: 1;
            padding: 20px;
        }

        .details h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        .details p {
            font-size: 16px;
            color: #666;
            margin-bottom: 10px;
        }

        .details a {
            text-decoration: none;
            color: #007bff;
        }

        .details a:hover {
            text-decoration: underline;
        }

        .other-images {
            display: flex;
            flex-wrap: wrap;
            margin-top: 20px;
            margin-top: 50px
        }

        .other-images .image {
            width: calc(33.33% - 20px);
            margin: 10px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .other-images img {
            max-width: 100%;
            height: auto;

        }

        .profile-link {
            color: inherit;
            text-decoration: none;
            transition: color 0.3s;
            font-size: 20px;
        }

        .profile-link:hover {
            color: #007bff;
        }
    </style>
</head>

<body>
    <a href="{{ route('home') }}" class="logo-back">
        <i class="fas fa-arrow-left"></i>
    </a>
    

    <div class="container">
        <div class="card-detail">
            <div class="image">
                <img src="{{ asset('upload/' . $foto->LokasiFIle) }}" alt="">
            </div>
            <div class="details">
                <h2>{{ $foto->JudulFoto }}</h2>
                <p>Uploaded by: <a href="{{ route('profile', ['username' => $foto->user->username]) }}"
                        class="profile-link">@ {{ $foto->user->nama_lengkap }}</a></p>
                <p>Description: {{ $foto->DeskripsiFoto }}</p>
                <p>Uploaded on: {{ $foto->TanggalUngguh }}</p>
            </div>
        </div>

        <div class="other-images">
            @foreach ($fotos as $item)
                <div class="image">
                    <img src="{{ asset('upload/' . $item->foto) }}" alt="">
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
