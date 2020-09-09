@extends("layouts.global")
@section("title") Create New Category @endsection

@section("content")
@section('pageTitle') Create New Category @endsection

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
        <form enctype="multipart/form-data" action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h4>Create New Category</h4>
                </div>
                <div class="card-body">

                    {{-- name --}}
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-tags"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control {{ $errors->first('name') ? "is-invalid" : "" }}"
                                name="name" value="{{ old('name') }}">
                            <div class="invalid-feedback">
                                {{$errors->first('name')}}
                            </div>
                        </div>
                    </div>

                    {{-- image --}}
                    <div class="form-group">
                        <label>Category Image</label>
                        <div class="custom-file">
                            <input type="file"
                                class="custom-file-input {{ $errors->first('image') ? "is-invalid" : "" }}"
                                name="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                            <div class="invalid-feedback">
                                {{ $errors->first('image') }}
                            </div>
                        </div>
                    </div>

                    <input class="btn btn-primary" type="submit" value="Save">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>

                </div>
            </div>
        </form>
    </div>
</div>

@endsection