@extends('layout.app')

@section('title', 'Create User')

@section('content')
    <div class="card col-md-6">

        <div class="card-header">Create User</div>

        <div class="card-body">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <input name="name" class="form-control mb-2" placeholder="Name">

                <input name="email" class="form-control mb-2" placeholder="Email">

                <input type="password" name="password" class="form-control mb-2" placeholder="Password">

                <select name="role" class="form-control mb-3">
                    <option value="admin">Admin</option>
                    <option value="ao">Account Officer</option>
                    <option value="direksi">Direksi</option>
                    <option value="nasabah">Nasabah</option>
                </select>

                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
