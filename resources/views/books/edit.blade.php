@extends("layouts.global")
@section('csslibraries')
<!-- Select2 css -->
<link rel="stylesheet" href="{{ asset('stisla/modules/select2/dist/css/select2.min.css') }}">
@endsection

@section("title") Edit Book @endsection

@section("content")
@section('pageTitle') Edit Book @endsection

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
        <form enctype="multipart/form-data" action="{{ route('books.update', [$book->id]) }}" method="POST">
            @csrf
            <input type="hidden" value="PUT" name="_method">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Book</h4>
                </div>
                <div class="card-header">
                    <h4>Create New Book</h4>
                </div>
                <div class="card-body">

                    {{-- title --}}
                    <div class="form-group">
                        <label for="title">Book Title</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-book"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="title" value="{{$book->title}}">
                        </div>
                    </div>

                    {{-- cover --}}
                    <div class="form-group">
                        <label>Book Cover</label>
                        <div class="row gutters-sm">
                            <div class="col-6 col-sm-4">
                                <label class="imagecheck mb-2">
                                    <figure class="imagecheck-figure">
                                        @if($book->cover)
                                        <img src="{{asset('storage/'.$book->cover)}}" class="imagecheck-image">
                                        <br>
                                        @else
                                        No image
                                        @endif
                                    </figure>
                                </label>
                            </div>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="cover">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah cover</small>
                    </div>

                    {{-- slug --}}
                    <div class="form-group">
                        <label for="slug">Book Slug</label>
                        <input type="text" class="form-control" name="slug" value="{{$book->slug}}">
                    </div>

                    {{-- description --}}
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description"
                            placeholder="Give a description about this book">{{$book->description}}</textarea>
                    </div>

                    {{-- category --}}
                    <div class="form-group">
                        <label>Categories</label>
                        <select id="categories" name="categories[]" multiple class="form-control select2"
                            data-height="100%" style="height: 100%">
                        </select>
                    </div>

                    {{-- Stock --}}
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" class="form-control" name="stock" id="stock" value="{{$book->stock}}">
                    </div>

                    {{-- author --}}
                    <div class="form-group">
                        <label for="author">Book Author</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" id="author" name="author" value="{{$book->author}}">
                        </div>
                    </div>

                    {{-- publisher --}}
                    <div class="form-group">
                        <label for="publisher">Book Publisher</label>
                        <input type="text" class="form-control" id="publisher" name="publisher"
                            value="{{$book->publisher}}">
                    </div>

                    {{-- price --}}
                    <div class="form-group">
                        <label for="price">Book Price</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">IDR</div>
                            </div>
                            <input type="text" class="form-control" name="price" id="price" value="{{$book->price}}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">00</div>
                            </div>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="form-group">
                        <label class="d-block">Status</label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" {{$book->status == "PUBLISH" ? "checked" : ""}} id="publish"
                                name="status" class="custom-control-input" value="PUBLISH">
                            <label class="custom-control-label" for="publish">PUBLISH</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" {{$book->status == "DRAFT" ? "checked" : ""}} id="draft" name="status"
                                class="custom-control-input" value="DRAFT">
                            <label class="custom-control-label" for="draft">DRAFT</label>
                        </div>
                    </div>

                    <button class="btn btn-primary" value="PUBLISH">Update</button>
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>

                </div>
            </div>
        </form>
    </div>
</div>

@endsection
{{-- end section content --}}

@section('jslibraries')
<!-- JS Libraies - Select2 js -->
<script src="{{ asset('stisla/modules/select2/dist/js/select2.full.min.js') }}"></script>
@endsection

@section('jspage')
<!-- Page Specific JS File - create book with category js -->
<script>
    $('#categories').select2({
    ajax: {
        url: "http://shovel.test/ajax/categories/search",
        processResults: function(data){
            return {
                results: data.map(function(item){
                    return {
                        id: item.id, 
                        text: item.name
                    } 
                })
            }
        }
    }
});  

    var categories = {!! $book->categories !!}
    categories.forEach(function(category){
        var option = new Option(category.name, category.id, true, true);
        $('#categories').append(option).trigger('change');
    });
</script>
@endsection