@extends('auth.layout.app')

@section('title', 'Login')
@section('body-class', 'login-page')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <b>Admin</b>LTE
        </div>

        <div class="card">
            <div class="card-body login-card-body">

                {{-- SUCCESS MESSAGE FROM REGISTER --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- ERROR MESSAGE --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <p class="login-box-msg">Sign in to start your session</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input name="email" type="email" class="form-control" placeholder="Email"
                            value="{{ old('email') }}" required>
                        <div class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input name="password" type="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-text">
                            <i class="bi bi-lock-fill"></i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-4 d-grid">
                            <button class="btn btn-primary">Sign In</button>
                        </div>
                    </div>
                </form>

                <p class="mt-3 text-center">
                    <a href="{{ route('register') }}">Register a new account</a>
                </p>

            </div>
        </div>
    </div>
@endsection
