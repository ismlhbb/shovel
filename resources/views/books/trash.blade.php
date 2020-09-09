@extends("layouts.global")

@section("title") Trashed Books @endsection

@section("content")
@section('pageTitle') Trashed Books @endsection

{{-- Filter section --}}
{{-- Filtering by name --}}
<div class="row mb-4">
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-body">
                <ul class="nav nav-pills">
                    {{-- Create new user button --}}
                    <li class="nav-item">
                        <a href="{{ route('books.create') }}" class="btn btn-primary mt-1">
                            Create New Book
                        </a>
                    </li>
                    {{-- filter by keyword --}}
                    <li class="nav-item mr-2">
                        <form action="{{ route('books.index') }}">
                            <div class="custom-control custom-control-inline input-group">
                                <input value="{{ Request::get('keyword') }}" name="keyword" class="form-control"
                                    type="text" placeholder="Insert title to filter...">
                                <div class="input-group-append">
                                    <button type="submit" value="Filter" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- Filtering by status --}}
<div class="row mb-4">
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item ml-2">
                        <a class="nav-link {{ Request::get('status') == NULL && Request::path() == 'books' ? 'active' : '' }}"
                            href="{{ route('books.index') }}">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::get('status') == 'publish' ? 'active' : '' }}"
                            href="{{ route('books.index', ['status' => 'publish']) }}">Publish</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::get('status') == 'draft' ? 'active' : '' }}"
                            href="{{ route('books.index', ['status' => 'draft']) }}">Draft</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('books.trash') ? 'active' : '' }}"
                            href="{{ route('books.trash') }}">Trash</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- List trashed books --}}
<div class="row">
    <div class="col">
        @if(session('status'))
        <div class="alert alert-info alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                {{session('status')}}
            </div>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4>All Trashed Books</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <tr>
                            <th>#</th>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Categories</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        @php $no = $books->firstItem(); @endphp
                        @foreach($books as $book)
                        <tr>
                            <td scope="row">{{ $no }}</td>
                            <td>
                                @if($book->cover)
                                <img src="{{asset('storage/'.$book->cover)}}" width="50px">
                                @endif
                            </td>
                            <td>{{$book->title}}</td>
                            <td>{{$book->author}}</td>
                            <td>
                                <ul class="pl-3">
                                    @foreach($book->categories as $category)
                                    <li>{{$category->name}}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{$book->stock}}</td>
                            <td>{{$book->price}}</td>


                            <td>
                                <form onsubmit="return confirm('Restore this book?')" class="d-inline"
                                    action="{{ route('books.restore', [$book->id]) }}" method="POST">
                                    @csrf
                                    <input type="submit" value="Restore" class="btn btn-info btn-sm">
                                </form>
                                <form onsubmit="return confirm('Delete this book permanently?')" class="d-inline"
                                    action="{{ route('books.delete-permanent', [$book->id]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                </form>
                            </td>
                        </tr>
                        @php $no ++ @endphp
                        @endforeach
                    </table>
                </div>
            </div>
            {{-- pagination --}}
            <div class="card-footer text-left">
                <nav class="d-inline-block">
                    <ul class="pagination mb-0">
                        {{ $books->appends(Request::all())->links() }}
                    </ul>
                </nav>
            </div>
            {{-- end pagination --}}
        </div>
    </div>
</div>

@endsection
{{-- end section content --}}

@section('jslibraries')
<!-- JS Libraies -->
<script src="{{ asset('stisla/modules/jquery-ui/jquery-ui.min.js') }}"></script>
@endsection

@section('jspage')
<!-- Page Specific JS File -->
<script src="{{ asset('stisla/js/page/components-table.js') }}"></script>
@endsection