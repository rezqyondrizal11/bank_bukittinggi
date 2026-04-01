@extends('auth.layout.app')

@section('title', 'Register')

@section('body-class', 'register-page')

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href="#"><b>Admin</b>LTE</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="register-box-msg">Register a new user</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input name="name" class="form-control" placeholder="Full Name" required>
                        <div class="input-group-text">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input name="email" type="email" class="form-control" placeholder="Email" required>
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
                            <button class="btn btn-primary">Register</button>
                        </div>
                    </div>
                </form>

                <p class="mt-3 text-center">
                    <a href="{{ route('login') }}">Already have account?</a>
                </p>
            </div>
        </div>
    </div>
@endsection
