@extends('layout.app')

@section('title', 'Edit User')

@section('content')
    <div class="card col-md-6">

        <div class="card-header">Edit User</div>

        <div class="card-body">
            <form method="POST" action="{{ route('users.update', $user) }}">
                @csrf @method('PUT')

                <input name="name" class="form-control mb-2" value="{{ $user->name }}">

                <input name="email" class="form-control mb-2" value="{{ $user->email }}">

                <input type="password" name="password" class="form-control mb-2" placeholder="New password (optional)">

                <select name="role" class="form-control mb-3">
                    <option value="admin" @selected($user->role == 'admin')>Admin</option>
                    <option value="ao" @selected($user->role == 'ao')>Account Officer</option>
                    <option value="direksi" @selected($user->role == 'direksi')>Direksi</option>
                    <option value="nasabah" @selected($user->role == 'nasabah')>Nasabah</option>
                </select>

                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
