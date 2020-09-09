@extends('layouts.app')
@section('title') Login @endsection
@section('pageTitle') Login @endsection
@section('content')

<div class="container mt-5">
    <div class="page-error">
        <div class="page-inner">
            <h1>403</h1>
            <div class="page-description">

                {{$exception->getMessage()}}
            </div>

            <div class="mt-5 mb-5">
                <a href="{{ route('home') }}">Back to Home</a>
            </div>
        </div>
    </div>
    <div class="simple-footer mt-5">
        Copyright &copy; Shovel 2020
    </div>
</div>

@endsection