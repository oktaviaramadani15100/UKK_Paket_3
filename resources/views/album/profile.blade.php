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
    <title>Profile</title>
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
</head>

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
                                    <li> <a href="home">Home</a> </li>
                                    <li> <a href="album">Upload</a> </li>
                                    <li class="active"> <a href="profilegallery">Profile</a></li>
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
    <div class="container-profile">
        <div class="profile">
            <img src="images/user.png" alt="">
        </div>
            <span class="profile-name">{{ Auth::user()->username }}</span>
            <span class="profile-email">{{ Auth::user()->email }}</span>

        <div class="upload-profile">
            <span>Upload</span>
        </div>

    <div class="card-album-prpfile">
        <div class="album-profile">
            @foreach ($datas as $items)
                <div class="card">
                    <a href="{{ route('detail', ['id' => $items->id]) }}"><img src="{{ asset('upload/' . $items->foto) }}" alt="" style="width: 200px; margin-left:65px; margin-top: 30px"></a>
                    <div class="intro">
                        <h1>{{ $items->NamaAlbum }}</h1>
                        <a href="{{ route('laporan.export',  $items->id) }}" download="pelapor.xlsx">
                            <img class="excel" src="images/excel.png" alt="Excel Icon">
                        </a>
                    </div>
                </div>
            @endforeach
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
    </script>
</body>

</html>
