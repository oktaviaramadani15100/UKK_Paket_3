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
            /* Tampilan vertikal */
            align-items: center;
            /* Memusatkan elemen secara horizontal */
            text-align: center;
            /* Memusatkan teks di dalam card-detail */
        }

        .card-detail {
            display: flex;
            width: 80%;
            /* Mengatur lebar maksimum kartu */
            max-width: 800px;
            /* Atur lebar maksimum kartu */
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Efek bayangan */
            margin-top: 50px
        }

        .card-detail .image {
            flex: 1;
        }

        .card-detail .image img {
            width: 59%;
            display: block;
            border-radius: 12px 0 0 12px;
            margin-left: 50px;
        }

        .card-detail .details {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
            background-color: #fff;
        }

        .card-detail .details h2 {
            margin-top: 0;
            text-align: center;
            font-size: 30px
        }

        .card-detail .details p {
            margin-bottom: 0;
            font-size: 18px
        }

        .card {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 50px;
            position: relative;
            margin-right: 20px;
            margin-left: 20px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 6px rgba(2, 1, 1, 3);
            align-items: flex-start;
        }

        .card img {
            width: 200px;
            /* Gambar mengisi seluruh lebar kartu */
            height: auto;
            /* Gambar disesuaikan tingginya secara proporsional */
            border-radius: 12px 12px 0 0;
            /* Sudut bulat hanya pada bagian atas kartu */
        }

        .card-container {
        display: flex; /* Menyusun div secara horizontal */
        flex-wrap: wrap; /* Mengizinkan pembungkusan pada baris yang baru jika ruang tidak mencukupi */
        justify-content: flex-start;
    }

    </style>
</head>

<body>
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
