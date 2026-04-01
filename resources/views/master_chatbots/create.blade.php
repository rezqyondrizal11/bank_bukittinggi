@extends('layout.app')

@section('title', 'Create Master Chatbot')

@section('content')
    <div class="card col-md-6">

        <div class="card-header">Create Master Chatbot</div>

        <div class="card-body">
            <form method="POST" action="{{ route('master_chatbots.store') }}">
                @csrf

                <input name="pertanyaan" class="form-control mb-2" placeholder="Pertanyaan">

                <input name="jawaban" class="form-control mb-2" placeholder="Jawaban">


                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
