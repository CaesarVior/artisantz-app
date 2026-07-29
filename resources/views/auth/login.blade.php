@extends('app')

@section('content')
    @include('components.alert')

    <style>
        /* Reset & layout style tetap sama */
        html,
        body {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            height: 100% !important;
            overflow-x: hidden;
        }

        main {
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
            min-height: 100vh !important;
        }

        .login-container {
            display: flex;
            width: 100vw;
            min-height: 100vh;
        }

        .login-left {
            width: 55%;
            height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .login-left img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .login-right {
            width: 45%;
            min-height: 100vh;
            background: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-content {
            width: 100%;
            max-width: 420px;
            padding: 40px;
        }

        .logo {
            margin-bottom: 60px;
        }

        .logo img {
            width: 150px;
            height: auto;
            display: block;
        }

        .login-header h1 {
            font-size: 38px;
            font-weight: 700;
            color: #111111;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #9a9a9a;
            font-size: 14px;
            margin-bottom: 35px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }

        .form-group input {
            width: 100%;
            height: 50px;
            border: 1px solid #dcdcdc;
            border-radius: 6px;
            padding: 0 15px;
            outline: none;
            font-size: 14px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #5d4df3;
        }

        .btn-submit {
            width: 100%;
            height: 50px;
            border: none;
            border-radius: 6px;
            background: #5d4df3;
            color: #ffffff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }

        .login-footer {
            margin-top: 25px;
        }

        .login-footer p {
            font-size: 14px;
            color: #888888;
            margin-bottom: 8px;
        }

        .login-footer a {
            color: #5d4df3;
            text-decoration: none;
            font-size: 14px;
        }
    </style>

    <div class="login-container">
        <div class="login-left">
            <img src="{{ asset('img/login.webp') }}" alt="Login Banner">
        </div>

        <div class="login-right">
            <div class="login-content">
                <div class="logo">
                    <a href="/">
                        <img src="{{ asset('img/artisantz-logo-no-bg.webp') }}" alt="Artisantz Logo" />
                    </a>
                </div>

                <div class="login-header">
                    <h1>Log In</h1>
                    <p>Enter your email and password to login our dashboard.</p>
                </div>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="info@example.com" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your Password" required>
                    </div>

                    <button type="submit" class="btn-submit">
                        Sign In
                    </button>
                </form>

                <div class="login-footer">
                    <p>Don't have an account? <a href="#">Sign Up</a></p>
                    <a href="#">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
@endsection
