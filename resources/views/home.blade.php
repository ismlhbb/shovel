@extends('layouts.global')
@section('title') Dashboard @endsection
@section('pageTitle') Dashboard @endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Dashboard</h4>
    </div>
    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <p> You are logged in!
        </p>
    </div>
</div>
@endsection