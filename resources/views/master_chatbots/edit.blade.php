@extends('layout.app')

@section('title', 'Edit Master Chatbot')

@section('content')
    <div class="card col-md-6">

        <div class="card-header">Edit Master Chatbot</div>

        <div class="card-body">
            <form method="POST" action="{{ route('master_chatbots.update', $data) }}">
                @csrf @method('PUT')

                <input name="pertanyaan" class="form-control mb-2" value="{{ $data->pertanyaan }}">

                <input name="jawaban" class="form-control mb-2" value="{{ $data->jawaban }}">


                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
