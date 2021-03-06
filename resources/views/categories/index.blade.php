@extends("layouts.global")

@section("title") List Categories @endsection

@section("content")
@section('pageTitle') List Categories @endsection

{{-- Filter section --}}
<div class="row mb-4">
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-body">
                <ul class="nav nav-pills">
                    {{-- Create new category button --}}
                    <li class="nav-item">
                        <a href="{{ route('categories.create') }}" class="btn btn-primary mt-1">
                            Create New Category
                        </a>
                    </li>
                    {{-- Filtering by name --}}
                    <li class="nav-item mr-2">
                        <form action="{{route('categories.index')}}">
                            <div class="custom-control custom-control-inline input-group">
                                <input value="{{ Request::get('name') }}" name="name" class="form-control" type="text"
                                    placeholder="Insert name to filter...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </li>

                    {{-- Filter by published or trashed --}}
                    <li class="nav-item ml-2">
                        <a class="active btn btn-secondary mt-1" href="{{ route('categories.index') }}">Published</a>
                    </li>
                    <li class="nav-item ml-2">
                        <a class="btn btn-secondary mt-1" href="{{route('categories.trash')}}">Trash</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- List all categories --}}
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
                <h4>All Categories</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        @php $no = $categories -> firstItem(); @endphp
                        @foreach($categories as $category)
                        <tr>
                            <td scope="row">{{ $no }}</td>
                            <td>{{$category->name}}</td>

                            <td>{{$category->slug}}</td>
                            <td>
                                @if($category->image)
                                <img src="{{asset('storage/'.$category->image)}}" width="50px">
                                @else
                                N/A
                                @endif
                            </td>
                            <td>
                                <a href="{{route('categories.show', [$category->id])}}"
                                    class="btn btn-primary btn-sm">Show</a>
                                <a href="{{ route('categories.edit', [$category->id]) }}"
                                    class="btn btn-success btn-sm">Edit</a>

                                <form onsubmit="return confirm('Move this category to trash?')" class="d-inline"
                                    action="{{route('categories.destroy', [$category->id])}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" value="Trash" class="btn btn-danger btn-sm">
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
                        {{ $categories->appends(Request::all())->links() }}
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