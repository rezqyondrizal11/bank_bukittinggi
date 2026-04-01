@extends('layout.app')

@section('title', 'Users')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h3 class="card-title mb-0">User List</h3>

            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm ms-auto">
                Add User
            </a>
        </div>


        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th width="150">Action</th>
                </tr>

                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge bg-info">{{ $user->role }}</span>
                        </td>
                        <td>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Hapus user?')" class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>
@endsection
