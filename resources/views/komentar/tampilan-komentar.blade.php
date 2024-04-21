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

        /* CSS untuk card foto */
        .container-foto {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }

        .card-foto {
            width: 400px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .card-foto img {
            width: 50%;
            height: auto;
            border-radius: 8px;
            margin-left: 90px
        }

        .gambar-info {
            margin-top: 20px;
        }

        .album-info {
            margin-left: 20px;
        }

        .album-info h3 {
            font-size: 30px;
            margin-bottom: 5px;
        }

        .album-info p {
            font-size: 20px;
            color: #555;
            margin: 0;
        }

        /* CSS untuk card komentar */
        .container-komentar {
            display: flex;
            margin-left: 580px;
            margin-top: 30px;

        }

        .card-komentar {
            width: 600px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 100px;

        }

        .komentar-card {
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 15px;
        }

        .komentar-content {
            margin-bottom: 10px;
        }

        .posted-by a {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 20px;
            color: black;
            /* Ubah warna teks menjadi hitam */
            text-decoration: none;
            /* Menghapus garis bawah */
        }

        .posted-by a:hover {
            color: #0056b3;
            /* Ubah warna teks menjadi biru saat dihover */
        }

        .komentar-content p {
            margin: 0;
        }

        .hapus {
            width: 20px;
            cursor: pointer;
            float: right;
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

        .logo-back,
        .container-komentar {
            display: inline-block;
            vertical-align: top;
        }

        .comment-form {
            margin-top: 20px;
        }

        .comment-input {
            width: 70%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
            flex: 1;
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

        .profile-link {
            color: black;
            font-weight: bold;
            text-decoration: none;
            font-size: 25px;
            transition: color 0.3s ease;
            /* Efek transisi warna saat dihover */
        }

        .profile-link:hover {
            color: #0056b3;
            /* Ubah warna teks saat dihover */
        }
    </style>
</head>

<body>
    <a href="{{ route('home') }}" class="logo-back">
        <i class="fas fa-arrow-left"></i>
    </a>

    <!-- Card untuk foto -->
    <div class="container-foto">
        <div class="card-foto">
            <img src="{{ asset('upload/' . $foto->LokasiFIle) }}" alt="">
            <div class="gambar-info">
                <div class="album-info">
                    <h3>{{ $foto->JudulFoto }}</h3>
                    <p>Uploaded by: <a href="{{ route('profile', ['username' => $foto->user->username]) }}"
                            class="profile-link">{{ $foto->user->username }}</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Card untuk komentar -->
    <div class="container-komentar">
        <div class="card-komentar">
            <h1>Komentar</h1>
            <div class="komentar-section">
                @foreach ($komentar as $komen)
                    <div class="komentar-card">
                        <div class="komentar-content">
                            <p class="posted-by"><a
                                    href="{{ route('profile', ['username' => $komen->user->username]) }}">{{ $komen->user->nama_lengkap }}</a>
                            </p>
                            <br>
                            <p>{{ $komen->IsiKomentar }}</p>
                            <p>{{ $komen->TanggalKomentar }}</p>
                            @if ($komen->user_id === Auth::id())
                                <img class="hapus" src="{{ asset('images/delete.png') }}" alt=""
                                    onclick="deleteComent({{ $komen->id }})">
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Form untuk menambah komentar -->
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
