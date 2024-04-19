<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <style>
        .container-detail {
            display: flex;
            flex-direction: column;
            margin-top: 20px
        }

        .card-detail {
            display: flex;
            width: 600px;
            height: 300px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            margin-left: 450px
        }

        .card-detail .image {
            flex: 1;
        }

        .card-detail img {
            width: 200px;
            height: 200px;
            margin-left: 50px;
            margin-top: 40px
        }

        .card-detail .details {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
        }

        .card-detail .details h2 {
            margin-top: 10px;
            font-size: 30px;
        }

        .card-detail .details p {
            margin-bottom: 0;
            font-size: 18px
        }

        .card {
            width: 250px;
            height: 250px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            margin-left: 40px;
        }

        .card img {
            width: 150px;
            height: auto;
            border-radius: 12px 12px 0 0;
            margin-top: 50px;
            margin-left: 50px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            padding: 10px;
            margin-top: 50px;
        }


        .logo-back {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logo-back:hover {
            background-color: #a8a6a6;
        }

        .logo-back a {
            color: inherit;
            /* Mengambil warna teks dari induknya */
            text-decoration: none;
            /* Menghapus garis bawah */
        }

        .logo-back,
        .container-detail {
            display: inline-block;
            vertical-align: top;
        }
    </style>
</head>

<body>
    <div class="logo-back">
        <a href="{{ route('profile') }}">
            <h1>Back</h1>
        </a>
    </div>

    <div class="container-detail">
        <div class="card-detail">
            <div class="image">
                <img src="{{ asset('upload/' . $album->foto) }}" alt="">
            </div>
            <div class="details">
                <h2>{{ $album->NamaAlbum }}</h2>
                <p>{{ $album->Deskripsi }}</p>
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
