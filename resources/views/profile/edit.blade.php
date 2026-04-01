@extends('layout.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>My Profile</h3>
        </div>

        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}">
                </div>

                <div class="mb-3">
                    <label>Password (optional)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <button class="btn btn-primary">Save</button>
            </form>

        </div>
    </div>
@endsection
