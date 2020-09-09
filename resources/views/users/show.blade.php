@extends("layouts.global")

@section("title") Detail User @endsection

@section("content")
@section('pageTitle') Detail User
@endsection

<div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card card-primary">
            <div class="card-header">
                <h4>User ID: {{$user->id}}</h4>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        @if($user->avatar)
                        <img src="{{asset('storage/'. $user->avatar)}}" width="128px">
                        @else
                        No avatar
                        @endif </li>
                    <li class="list-group-item"><b>Name:</b><br>{{$user->name}}</li>
                    <li class="list-group-item"><b>Username:</b><br>{{$user->email}}</li>
                    <li class="list-group-item"><b>Phone Number:</b><br>{{$user->phone}}</li>
                    <li class="list-group-item"><b>Address:</b><br>{{$user->address}}</li>
                    <li class="list-group-item">
                        <b>Roles:</b><br>
                        @foreach (json_decode($user->roles) as $role)
                        &middot; {{$role}} <br>
                        @endforeach
                    </li>
                </ul>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>

@endsection