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
    <title>gallery foto</title>
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

<body class="main-layout">
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
                                    <li class="active"> <a href="home">Home</a> </li>
                                    <li> <a href="uploadGallery">Upload</a> </li>
                                    <li> <a href="profilegallery">Profile</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                    @guest <!-- Cek apakah pengguna belum login -->
                        <li><a class="buy" href="{{ route('loginAwal') }}">Login</a></li>
                    @else
                        <!-- Jika pengguna sudah login -->
                        <li>
                            <a class="buy" href="{{ route('actionLogout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                            <form id="logout-form" action="{{ route('actionLogout') }}" method="get"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </div>


                <div class="profile-picture">
                    <p>{{ session('user_initial') }}</p>
                </div>
            </div>
        </div>
        <!-- end header inner -->
    </header>
    <!-- end header -->
    <section class="slider_section">
        <div id="main_slider" class="carousel slide banner-main" data-ride="carousel">
            <br>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="first-slide" src="images/banner2.jpg" alt="First slide">
                    <div class="container">
                        <div class="carousel-caption relative">
                            <h1>welcome <br> <strong class="black_bold">to </strong><br>
                                <strong class="yellow_bold">Gallery</strong> <br> <strong
                                    class="yellow_bold">ArtVista</strong>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <br>
    <br>


    <!-- our product -->
    <div class="product">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>Gallery <strong class="black">ARTVISTA
                            </strong></h2>
                        <span>Treat yourself to top-tier service and elevate your gallery experience with us.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="image-info">
                <img id="modal-image" src="" alt="">
                <div class="info">
                    <h1 id="modal-album-name"></h1>
                    <p id="modal-description"></p>

                    <ul id="modal-comments">
                        <!-- Komentar akan ditambahkan secara dinamis di sini menggunakan JavaScript -->
                    </ul>
                </div>
            </div>
            <form action="{{ route('storeKomentar') }}" method="POST" enctype="multipart/form-data" id="comment-form"
                class="form-coment">
                @csrf
                <input type="hidden" name="foto_id" id="foto_id" value="" required />
                <h2>Komentar</h2>
                <input class="komen" type="text" name="isi_komentar" id="isi_komentar"
                    placeholder="Tambahkan komentar" required />
                <button type="submit">Kirim Komentar</button>
            </form>
        </div>
    </div> --}}

    <div class="content-grid">
        <div class="grid-wrapper" style="margin-left: 130px">
            @foreach ($data as $row)
                <div class="card">
                    <img class="foto-file" src="{{ asset('upload/' . $row->LokasiFIle) }}" alt=""
                        style="width: 200px; display: block; margin: 0 auto; margin-top: 20px">
                    <div class="intro">
                        <h1>{{ $row->JudulFoto }}</h1>
                        <div class="actions">
                            <img class="like" src="images/like.png" alt=""
                                onclick="toggleLike(this, {{ $row->id }}, {{ auth()->id() }})">
                            <span class="like-count-{{ $row->id }}">{{ $row->total_likes }}</span>
                            <a href="{{ route('tampilanKomentar', ['id' => $row->id]) }}" class="komentar-link">
                                <img class="komen" src="images/coment.png" alt="">
                            </a>
                            <span class="total-komentar">{{ $row->total_komentar }}</span>
                            <img class="hapus" src="images/delete.png" alt=""
                                onclick="deleteImage({{ $row->id }})">
                            <a href="{{ route('pelaporan-foto.export', $row->id) }}" download="laporan-foto.xlsx">
                                <img class="excel-foto" src="images/excel.png" alt="">
                            </a>
                        </div>
                        <br>
                        <p class="description">{{ $row->DeskripsiFoto }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>



    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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


        });

        function toggleLike(element, fotoId, userId) {
            $.ajax({
                url: '/like/' + fotoId,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    user_id: userId
                },
                success: function(response) {
                    var likeCountElement = $('.like-count-' + fotoId);

                    if (response.status === 'liked') {
                        element.classList.add('liked');
                    } else if (response.status === 'unliked') {
                        element.classList.remove('liked');
                    }

                    likeCountElement.text(response.total_likes);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }




        function deleteImage(id) {
            if (confirm("Apakah Anda yakin ingin menghapus gambar ini?")) {
                $.ajax({
                    url: '/delete/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.success);
                        location.reload(); // Ini akan me-refresh halaman saat ini
                    },
                    error: function(xhr, status, error) {
                        var err = JSON.parse(xhr.responseText);
                        alert(err.error);
                    }
                });
            }
        }


        // // Open the modal with image details
        // function openModal(albumName, description, fotoId) {
        //     var modal = document.getElementById('modal');
        //     var modalImage = document.getElementById('modal-image');
        //     var modalAlbumName = document.getElementById('modal-album-name');
        //     var modalDescription = document.getElementById('modal-description');
        //     var fotoIdInput = document.getElementById('foto_id');

        //     modalImage.src = event.target.src;
        //     modalAlbumName.innerText = albumName;
        //     modalDescription.innerText = description;

        //     // Set nilai foto_id pada input tersembunyi
        //     fotoIdInput.value = fotoId;

        //     modal.style.display = 'block';
        // }


        // // Close the modal
        // function closeModal() {
        //     var modal = document.getElementById('modal');
        //     modal.style.display = 'none';
        // }

        // // Close the modal when clicking outside of it
        // window.onclick = function(event) {
        //     var modal = document.getElementById('modal');
        //     if (event.target == modal) {
        //         modal.style.display = 'none';
        //     }
        // }

        // // Fungsi untuk menangani pengiriman formulir komentar
        // function handleSubmit(event) {
        //     event.preventDefault(); // Menghentikan perilaku bawaan dari formulir

        //     // Tangkap nilai komentar dari input formulir
        //     var commentInput = document.getElementById('isi_komentar');
        //     var commentText = commentInput.value;

        //     // Buat elemen HTML baru untuk menampilkan komentar baru
        //     var commentElement = document.createElement('li');
        //     var commentTextNode = document.createTextNode(commentText);
        //     commentElement.appendChild(commentTextNode);

        //     // Temukan daftar komentar
        //     var commentsList = document.getElementById('modal-comments');

        //     // Tambahkan komentar baru ke dalam daftar komentar
        //     commentsList.appendChild(commentElement);

        //     // Kosongkan nilai input komentar setelah dikirim
        //     commentInput.value = '';
        // }

        // // Event listener untuk formulir komentar
        // document.getElementById('comment-form').addEventListener('submit', handleSubmit);
    </script>
</body>

</html>
