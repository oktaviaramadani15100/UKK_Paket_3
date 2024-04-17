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

            margin-bottom: 20px;
        }

        .card-detail .image {
            flex: 1;
        }

        .card-detail .image img {
            width: 100%;
            display: block;
            border-radius: 12px 0 0 12px;
            /* Mengatur sudut bulat pada gambar */
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
            margin-left: 120px;
            font-size: 18px
        }

        .card {
            width: 300px;
            /* Atur lebar kartu */
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            /* Mengatasi masalah overflow gambar */
            margin-bottom: 20px;
            position: relative;
            /* Membuat posisi relatif agar child elements bisa diatur posisinya */
            margin-right: 20px;
            /* Atur jarak antara kartu-kartu */
            margin-left: 20px;
            /* Atur jarak antara kartu-kartu */
            display: flex;
            /* Atur kartu menjadi flexbox */
            flex-direction: column;
            /* Tumpuk elemen-elemen di dalam kartu secara vertikal */
            box-shadow: 0 4px 6px rgba(2, 1, 1, 3);
        }

        .card img {
            width: 25%;
            /* Gambar mengisi seluruh lebar kartu */
            height: auto;
            /* Gambar disesuaikan tingginya secara proporsional */
            border-radius: 12px 12px 0 0;
            /* Sudut bulat hanya pada bagian atas kartu */
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


        @foreach ($fotos as $foto)
            <div class="card">
                <img src="{{ asset('upload/' . $foto->LokasiFIle) }}" alt="">
            </div>
        @endforeach

    </div>



</body>

</html>
