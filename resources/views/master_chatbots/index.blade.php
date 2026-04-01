@extends('layout.app')

@section('title', 'Master Chatbots')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h3 class="card-title mb-0">Master Chatbot List</h3>

            <a href="{{ route('master_chatbots.create') }}" class="btn btn-primary btn-sm ms-auto">
                Add Master Chatbot
            </a>
        </div>


        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Pertanyaan</th>
                    <th>Jawaban</th>

                    <th width="150">Action</th>
                </tr>

                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->pertanyaan }}</td>
                        <td>{{ $item->jawaban }}</td>

                        <td>
                            <a href="{{ route('master_chatbots.edit', $item) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('master_chatbots.destroy', $item) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Hapus master chatbot?')" class="btn btn-danger btn-sm">
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
