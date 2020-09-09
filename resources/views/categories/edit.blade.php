@extends("layouts.global")

@section("title") Edit Category @endsection

@section("content")
@section('pageTitle') Edit Category @endsection

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
        <form enctype="multipart/form-data" action="{{ route('categories.update', [$category->id]) }}" method="POST">
            @csrf
            <input type="hidden" value="PUT" name="_method">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Category</h4>
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
                            <input type="text" class="form-control" name="name" value="{{$category->name}}">
                        </div>
                    </div>

                    {{-- slug --}}
                    <div class="form-group">
                        <label for="slug">Category Slug</label>
                        <input type="text" class="form-control" name="slug" value="{{$category->slug}}">
                    </div>

                    {{-- image --}}
                    <div class="form-group">
                        <label>Category Image</label>
                        <div class="row gutters-sm">
                            <div class="col-6 col-sm-4">
                                <label class="imagecheck mb-2">
                                    <figure class="imagecheck-figure">
                                        @if($category->image)
                                        <img src="{{asset('storage/'.$category->image)}}" class="imagecheck-image">
                                        <br>
                                        @else
                                        No image
                                        @endif
                                    </figure>
                                </label>
                            </div>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                    </div>

                    <input class="btn btn-primary" type="submit" value="Update">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>

                </div>
            </div>
        </form>
    </div>
</div>

@endsection