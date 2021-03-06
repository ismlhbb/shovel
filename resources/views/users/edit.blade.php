@extends("layouts.global")
@section("title") Edit User @endsection

@section("content")
@section('pageTitle') Edit User @endsection

<div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        @if(session('status'))
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                {{session('status')}}
            </div>
        </div>
        @endif
        <form enctype="multipart/form-data" action="{{ route('users.update', [$user->id]) }}" method="POST">
            @csrf
            <input type="hidden" value="PUT" name="_method">
            <div class="card">
                <div class="card-header">
                    <h4>Edit User</h4>
                </div>
                <div class="card-body">

                    {{-- name --}}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="far fa-user"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control {{ $errors->first('name') ? "is-invalid" : "" }}"
                                name="name" id="name" value="{{ old('name') ? old('name') : $user->name }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        </div>
                    </div>

                    {{-- Username --}}
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                            </div>
                            <input type="text" class="form-control" name="username" id="username"
                                value="{{$user->username}}" disabled>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="form-group">
                        <label class="d-block">Status</label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" {{$user->status == "ACTIVE" ? "checked" : ""}} id="active" name="status"
                                class="custom-control-input" value="ACTIVE">
                            <label class="custom-control-label" for="active">ACTIVE</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" {{$user->status == "INACTIVE" ? "checked" : ""}} id="inactive"
                                name="status" class="custom-control-input" value="INACTIVE">
                            <label class="custom-control-label" for="inactive">INACTIVE</label>
                        </div>
                    </div>

                    {{-- Roles --}}
                    <div class="form-group">
                        <label class="d-block" for="roles[]">Roles</label>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" {{ in_array("ADMIN", json_decode($user->roles)) ? "checked" : "" }}
                                class="custom-control-input {{ $errors->first('roles') ? "is-invalid" : "" }}"
                                name="roles[]" id="ADMIN" value="ADMIN">
                            <label class="custom-control-label" for="ADMIN">Administrator</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" {{ in_array("STAFF", json_decode($user->roles)) ? "checked" : "" }}
                                class="custom-control-input {{ $errors->first('roles') ? "is-invalid" : "" }}"
                                name="roles[]" id="STAFF" value="STAFF">
                            <label class="custom-control-label" for="STAFF">Staff</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox"
                                {{ in_array("CUSTOMER", json_decode($user->roles)) ? "checked" : "" }}
                                class="custom-control-input {{ $errors->first('roles') ? "is-invalid" : "" }}"
                                name="roles[]" id="CUSTOMER" value="CUSTOMER">
                            <label class="custom-control-label" for="CUSTOMER">Customer</label>
                        </div>
                        <div class="input-group invalid-feedback">
                            {{ $errors->first('roles') }}
                        </div>
                    </div>

                    {{-- phone number --}}
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-phone"></i>
                                </div>
                            </div>
                            <input type="tel" name="phone"
                                class="form-control {{ $errors->first('phone') ? "is-invalid" : "" }}"
                                value="{{ old('phone') ? old('phone') : $user->phone }}">
                            <div class="invalid-feedback">
                                {{$errors->first('phone')}}
                            </div>
                        </div>
                    </div>

                    {{-- address --}}
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control {{ $errors->first('address') ? "is-invalid" : "" }}"
                            name="address"
                            id="address">{{ old('address') ? old('address') : $user->address }}</textarea>
                        <div class="invalid-feedback">
                            {{$errors->first('address')}}
                        </div>
                    </div>

                    {{-- avatar --}}
                    <div class="form-group">
                        <label>Avatar</label>
                        <div class="row gutters-sm">
                            <div class="col-6 col-sm-4">
                                <label class="imagecheck mb-2">
                                    <figure class="imagecheck-figure">
                                        @if($user->avatar)
                                        <img src="{{asset('storage/'.$user->avatar)}}" class="imagecheck-image">
                                        <br>
                                        @else
                                        No avatar
                                        @endif
                                    </figure>
                                </label>
                            </div>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="avatar" id="avatar">
                            <label class="custom-file-label" for="avatar">Choose file</label>
                        </div>
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>
                    </div>

                    {{-- email --}}
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                            <input type="email" value="{{$user->email}}" class="form-control" name="email" id="email"
                                disabled>
                        </div>
                    </div>

                    <input class="btn btn-primary" type="submit" value="Save">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>

                </div>
            </div>
        </form>
    </div>
</div>

@endsection