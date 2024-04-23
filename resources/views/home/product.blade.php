<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Upload</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<!-- body -->

<body class="main-layout product_page">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#" /></div>
    </div>
    <!-- end loader -->
    <!-- header -->
    <header>
        <!-- header inner -->
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                    <div class="logo-area">
                        <img src="images/logoJudul.png" alt="Logo" style="width: 200px;">
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-9 col-sm-9">
                    <div class="menu-area">
                        <div class="limit-box">
                            <nav class="main-menu">
                                <ul class="menu-area-main">
                                    <li> <a href="home">Home</a> </li>
                                    <li class="active"> <a href="uploadGallery">Upload</a> </li>
                                    <li> <a
                                            href="{{ route('profile', ['username' => Auth::user()->username]) }}">Profile</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                    <li><a class="buy" href="loginAwal">Login</a></li>
                </div>

                <div class="profile-picture">
                    <a href="{{ route('profile', ['username' => Auth::user()->username]) }}">
                        <p>{{ session('user_initial') }}</p>
                    </a>
                </div>

            </div>
        </div>
        <!-- end header inner -->
    </header>
    <!-- end header -->

    <div class="brand_color">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Upload</h2>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- our product -->
    <div class="product">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <span>Unveil your memories in our gallery, where each image is carefully curated to evoke joy
                            and nostalgia. Share your cherished moments with us as we transform them into timeless
                            treasures. <br> Let us weave your stories into a tapestry of happiness, creating smiles that
                            last a lifetime</span>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- uploadGallery -->
    <div class="container-button-upload">
        <div class="center-buttons">
            <button id="toggle-upload" class="btn">Upload Foto</button>
            <button id="toggle-album" class="btn">Buat Album</button>
        </div>
    </div>

    <form action="{{ route('storeFotoGallery') }}" method="POST" enctype="multipart/form-data" id="upload-form"
        style="display: none; margin-top: 50px">
        @csrf
        <div class="upload-card">
            <label for="upload-input" class="upload-label">
                <img src="images/down.png" alt="" class="upload-icon">
                <span class="upload-text">Pilih file foto yang ingin di upload</span>
            </label>
            <input type="file" id="upload-input" class="upload-input" name="LokasiFIle">
            <div id="uploaded-photo" style="display: none;">
                <div class="image-container">
                    <img id="uploaded-image" src="" alt="Uploaded Photo">
                </div>
            </div>
        </div>

        <div class="input-container" id="judul-container">
            <label for="judul_foto" class="input-label">Judul Foto</label>
            <input type="text" placeholder="Tambahkan Judul" name="judul_foto" id="judul_foto">
        </div>

        <div class="input-container" id="deskripsi-container">
            <label for="deskripsi_foto" class="input-label">Deskripsi Foto</label>
            <input type="text" placeholder="Tambahkan Deskripsi" name="deskripsi_foto" id="deskripsi_foto">
        </div>

        <div class="input-container" id="foto_album_id_container">
            <label for="album_id" class="input-label">Album_id</label>
            <select name="album_id" id="album_id">
                @foreach ($userAlbums as $id => $NamaAlbum)
                    <option value="{{ $id }}">{{ $NamaAlbum }}</option>
                @endforeach
            </select>
        </div>

        <div class="button-container" id="button-container" style="display: none;">
            <input type="submit" class="btn">
        </div>
    </form>

    <form action="{{ route('storeAlbumGallery') }}" method="POST" enctype="multipart/form-data" id="buat-form"
        style="display: none; margin-top: 50px;">
        @csrf
        <div class="upload-card">
            <label for="upload-input-album" class="upload-label">
                <img src="images/down.png" alt="" class="upload-icon">
                <span class="upload-text">Pilih file album yang ingin dibuat</span>
            </label>
            <input type="file" id="upload-input-album" class="upload-input-album" name="foto">
            <div id="uploaded-album" style="display: none;">
                <div class="image-container">
                    <img id="uploaded-image-album" src="" alt="Uploaded Photo">
                </div>
            </div>
        </div>


        <div class="input-container" id="nama-container" style="display: none;">
            <label for="judul_foto">Nama Album</label>
            <input type="text" placeholder="Tambahkan Judul" name="judul_album" id="judul_album">
        </div>

        <div class="input-container" id="deskripsi-album-container" style="display: none;">
            <label for="deskripsi_foto">Deskripsi Album</label>
            <input type="text" placeholder="Tambahkan Deskripsi" name="deskripsi_album" id="deskripsi_album">
        </div>


        <div class="button-container" id="submit-container" style="display: none;">
            <input type="submit" class="btn">
        </div>
    </form>




    <br>
    <br>
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });

            $(".zoom").hover(function() {

                $(this).addClass('transition');
            }, function() {

                $(this).removeClass('transition');
            });

            // Get the button and form elements
            var toggleUploadButton = document.getElementById('toggle-upload');
            var toggleBuatdButton = document.getElementById('toggle-album');
            var uploadForm = document.getElementById('upload-form');
            var buatForm = document.getElementById('buat-form');

            // Add click event listener to the button
            toggleUploadButton.addEventListener('click', function() {
                // Toggle the display of the upload form
                uploadForm.style.display = (uploadForm.style.display === 'none') ? 'block' : 'none';
            });

            toggleBuatdButton.addEventListener('click', function() {
                // Toggle the display of the upload form
                buatForm.style.display = (buatForm.style.display === 'none') ? 'block' : 'none';
            });



            //uploadGambar
            document.getElementById('upload-input').addEventListener('change', function() {

                if (this.files && this.files[0]) {
                    // Tampilkan input judul dan deskripsi
                    document.getElementById('judul-container').style.display = 'block';
                    document.getElementById('deskripsi-container').style.display = 'block';
                    document.getElementById('button-container').style.display = 'block';
                    document.getElementById('foto_album_id_container').style.display = 'block';

                    // Membaca file gambar menggunakan FileReader
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#uploaded-image').attr('src', e.target
                            .result); // Set atribut src dari gambar
                        $('#uploaded-photo').show(); // Tampilkan div untuk gambar yang diunggah
                    };
                    reader.readAsDataURL(this.files[0]); // Membaca file gambar sebagai URL data
                }

                var albumId = document.getElementById('album_id').value;
                if (!albumId) {
                    event.preventDefault(); // Mencegah form disubmit
                    alert('Harap pilih album sebelum mengunggah foto.');
                }
            });

            document.getElementById('upload-input-album').addEventListener('change', function() {
                // Jika ada file yang dipilih
                if (this.files && this.files[0]) {
                    // Tampilkan input judul dan deskripsi
                    document.getElementById('nama-container').style.display = 'block';
                    document.getElementById('deskripsi-album-container').style.display = 'block';
                    document.getElementById('submit-container').style.display = 'block';


                    // Membaca file gambar menggunakan FileReader
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#uploaded-image-album').attr('src', e.target
                            .result);
                        $('#uploaded-album').show(); // Tampilkan div untuk gambar yang diunggah
                    };
                    reader.readAsDataURL(this.files[0]); // Membaca file gambar sebagai URL data
                }
            });

        });
    </script>
</body>

</html>
