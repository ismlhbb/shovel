@extends("layouts.global")
@section('csslibraries')
<!-- Select2 css -->
<link rel="stylesheet" href="{{ asset('stisla/modules/select2/dist/css/select2.min.css') }}">
@endsection

@section("title") Create New Book @endsection

@section("content")
@section('pageTitle') Create New Book @endsection

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
        <form enctype="multipart/form-data" action="{{ route('books.store') }}" method="POST">
            @csrf
            <div class="card">
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
                            <input type="text" class="form-control" name="title">
                        </div>
                    </div>

                    {{-- cover --}}
                    <div class="form-group">
                        <label>Book Cover</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="cover">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                    </div>

                    {{-- description --}}
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description"
                            placeholder="Give a description about this book"></textarea>
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
                        <input type="number" class="form-control" name="stock" id="stock" min=0 value=0>
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
                            <input type="text" class="form-control" id="author" name="author">
                        </div>
                    </div>

                    {{-- publisher --}}
                    <div class="form-group">
                        <label for="publisher">Book Publisher</label>
                        <input type="text" class="form-control" id="publisher" name="publisher">
                    </div>

                    {{-- price --}}
                    <div class="form-group">
                        <label for="price">Book Price</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">IDR</div>
                            </div>
                            <input type="text" class="form-control" name="price" id="price">
                            <div class="input-group-prepend">
                                <div class="input-group-text">00</div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit" name="save_action" value="PUBLISH">Publish</button>
                    <button class="btn btn-success" type="submit" name="save_action" value="DRAFT">Draft</button>
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
</script>
@endsection