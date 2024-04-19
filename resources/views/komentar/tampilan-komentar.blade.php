<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        /* CSS untuk card komentar */
        .container-komentar {
            display: flex;
            justify-content: center;
            margin-top: 100px;
        }

        .card-komentar {
            width: 600px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .card-komentar img {
            width: 25%;
            border-radius: 8px;
        }

        .card-komentar:hover {
            transform: scale(1.05);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .gambar-info {
            display: flex;
        }

        .album-info {
            margin-left: 50px;
        }

        .album-info h3 {
            font-size: 25px;
            margin-bottom: 5px;
        }

        .album-info p {
            font-size: 15px;
            color: #555;
        }

        .card-komentar h1 {
            margin-top: 10px;
            /* Beri jarak atas untuk elemen <h1> */
            font-size: 20px;
            /* Sesuaikan ukuran teks sesuai kebutuhan */
            color: #333;
            /* Sesuaikan warna teks sesuai kebutuhan */

        }

        .comment-form {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        .comment-input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
            flex: 1;
            /* Menggunakan flex untuk mengisi ruang yang tersedia */
        }

        .btn-submit {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .komentar-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            margin-top: 10px;
            position: relative;

        }

        .komentar-content {
            padding: 15px;
        }

        .posted-by {
            display: block;
            margin-top: 10px;
        }

        .komentar-content img {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 30px;
            cursor: pointer;
            /* Ubah cursor menjadi pointer saat dihover */
        }
    </style>
</head>

<body>
    <div class="container-komentar">
        <div class="card-komentar">
            <div class="gambar-info">
                <img src="{{ asset('upload/' . $foto->LokasiFIle) }}" alt="">
                <div class="album-info">
                    <h3>{{ $foto->JudulFoto }}</h3>
                    <p>{{ $foto->DeskripsiFoto }}</p>
                </div>
            </div>

            <div class="komentar-section">
                @foreach ($komentar as $komen)
                    <div class="komentar-card">
                        <div class="komentar-content">
                            <h1>{{ $komen->user->nama_lengkap }} :</h1>
                            <p class="posted-by">{{ $komen->IsiKomentar }}</p>
                            <img class="hapus" src="{{ asset('images/delete.png') }}" alt=""
                                onclick="deleteComent({{ $komen->id }})">
                        </div>
                    </div>
                @endforeach
            </div>


            <h1>komentar</h1>
            <form action="{{ route('storeKomentar') }}" method="POST" enctype="multipart/form-data"
                class="comment-form">
                @csrf
                <input type="hidden" name="foto_id" value="{{ $foto->id }}">
                <input type="text" placeholder="Komentar" name="komentar" class="comment-input" required>
                <button type="submit" class="btn-submit">Kirim</button>
            </form>

        </div>
    </div>


</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function deleteComent(id) {
        if (confirm("Apakah Anda yakin ingin menghapus komentar ini?")) {
            $.ajax({
                url: '/deleteComent/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.success);
                    // Hapus elemen HTML yang sesuai dari daftar komentar
                    $('#komentar-' + id).remove();
                    location.reload();
                },
                error: function(xhr, status, error) {
                    var err = JSON.parse(xhr.responseText);
                    alert(err.error);
                }
            });
        }
    }
</script>

</html>
