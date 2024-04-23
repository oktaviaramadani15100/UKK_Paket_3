<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 200px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            resize: vertical;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Album</h2>
        <form action="{{ route('updateAlbum', ['id' => $album->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="NamaAlbum">Nama Album</label>
                <input type="text" class="form-control" id="NamaAlbum" name="NamaAlbum" value="{{ $album->NamaAlbum }}">
            </div>
            <div class="form-group">
                <label for="DeskripsiAlbum">Deskripsi Album</label>
                <textarea class="form-control" id="DeskripsiAlbum" name="DeskripsiAlbum" rows="3">{{ $album->Deskripsi }}</textarea>
            </div>
            <!-- Tambahkan input lainnya sesuai kebutuhan -->
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>

</html>
