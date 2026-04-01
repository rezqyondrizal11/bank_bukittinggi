@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
    <h1>Welcome, {{ auth()->user()->name }}</h1>
    <p>Role: {{ auth()->user()->role }}</p>
@endsection
