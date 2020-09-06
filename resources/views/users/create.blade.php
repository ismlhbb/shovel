@extends("layouts.global")

@section("title") Create New User @endsection

@section("content")
@section('pageTitle') Create New User @endsection

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
        <form enctype="multipart/form-data" action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h4>Create New User</h4>
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
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                    </div>

                    {{-- Username --}}
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                            </div>
                            <input type="text" class="form-control" name="username" id="username">
                        </div>
                    </div>

                    {{-- Roles --}}
                    <div class="form-group">
                        <label class="d-block" for="roles[]">Roles</label>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" name="roles[]" id="ADMIN" value="ADMIN">
                            <label class="custom-control-label" for="ADMIN">Administrator</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" name="roles[]" id="STAFF" value="STAFF">
                            <label class="custom-control-label" for="STAFF">Staff</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" name="roles[]" id="CUSTOMER"
                                value="CUSTOMER">
                            <label class="custom-control-label" for="CUSTOMER">Customer</label>
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
                            <input type="tel" name="phone" class="form-control">
                        </div>
                    </div>

                    {{-- address --}}
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" name="address" id="address"></textarea>
                    </div>

                    {{-- avatar --}}
                    <div class="form-group">
                        <label>Avatar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="avatar" id="avatar">
                            <label class="custom-file-label" for="avatar">Choose file</label>
                        </div>
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
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </div>
                            </div>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                    </div>

                    {{-- Password Confirmation--}}
                    <div class="form-group">
                        <label for="password_confirmation">Password Confirmation</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </div>
                            </div>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control">
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