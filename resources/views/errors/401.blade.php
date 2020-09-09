@extends('layouts.app')
@section('title') Login @endsection
@section('pageTitle') Login @endsection
@section('content')

<div class="container mt-5">
    <div class="page-error">
        <div class="page-inner">
            <h1>401</h1>
            <div class="page-description">
                You are not login!
            </div>

            <div class="mt-5 mb-5">
                <a href="{{ route('login') }}">Login</a>
            </div>
        </div>
    </div>
    <div class="simple-footer mt-5">
        Copyright &copy; Shovel 2020
    </div>
</div>

@endsection