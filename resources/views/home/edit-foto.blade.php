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
        <h2>Edit Foto</h2>
        <form action="{{ route('updateFoto', ['id' => $foto->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="JudulFoto">Judul Foto</label>
                <input type="text" class="form-control" id="JudulFoto" name="JudulFoto" value="{{ $foto->JudulFoto }}">
            </div>
            <div class="form-group">
                <label for="DeskripsiFoto">Deskripsi Foto</label>
                <textarea class="form-control" id="DeskripsiFoto" name="DeskripsiFoto" rows="3">{{ $foto->DeskripsiFoto }}</textarea>
            </div>
            <!-- Tambahkan input lainnya sesuai kebutuhan -->
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>

</html>
