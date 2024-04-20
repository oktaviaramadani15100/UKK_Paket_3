<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
    <title>sign-sigup</title>
</head>
<body>
    <div class="container">
        <div class="signin-signup">
            <form action="{{ route('postLogin') }}" method="POST" class="sign-in-form">
                @csrf
                <h2 class="title">Sign In</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="email" placeholder="Email" value="{{ Session::get('email') }}" name="email">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" name="password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <input type="submit" value="Login" class="btn">
                <p class="social-text">Or Sign in with social platform</p>
                <div class="social-media">
                    <a href="" class="social-icon">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </form>

            <form action="{{ route('postRegister') }}" method="POST" class="sign-up-form">
                @csrf
                <h2 class="title">Sign Up</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Username" name="username" value="{{ old('username') }}">
                    @error('username')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="Email" name="email" value="{{ old('email') }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>  

                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Nama Lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}">
                    @error('nama_lengkap')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-field">
                    <i class="fas fa-location"></i>
                    <input type="text" placeholder="Alamat" name="alamat" value="{{ old('alamat') }}">
                    @error('alamat')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" name="password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Confirm Password" name="password_confirmation">
                </div>
            
                <input type="submit" value="Register" class="btn">
                <p class="social-text">Or Sign in with social platform</p>
                <div class="social-media">
                    <a href="" class="social-icon">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </form>
            
        </div>
        <div class="panels-container">
            <div class="panel lift-panel">
                <div class="content">
                    <h3>Member of Brand?</h3>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsam itaque alias ut labore quia illum!</p>
                    <button class="btn" id="sign-in-btn">Sign In</button>
                </div>
                <img src="images/login.svg" alt="" class="image">
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h3>New to Brand?</h3>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsam itaque alias ut labore quia illum!</p>
                    <button class="btn" id="sign-up-btn">Sign Up</button>
                </div>
                <img src="images/register.svg" alt="" class="image">
            </div>
        </div>
    </div>
    <script src="js/app.js"></script>
</body>
</html>