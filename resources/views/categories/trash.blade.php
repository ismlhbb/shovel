@extends("layouts.global")

@section("title") Trashed Categories @endsection

@section("content")
@section('pageTitle') Trashed Categories @endsection

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
                    <li class="nav-item ml-2">
                        <form action="{{route('categories.index')}}">
                            <div class="custom-control custom-control-inline">
                                <input value="{{ Request::get('name') }}" name="name" class="form-control" type="text"
                                    placeholder="Insert name to filter..." />
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </form>
                    </li>

                    {{-- Filter by published or trashed --}}
                    <li class="nav-item ml-2">
                        <a class="btn btn-secondary mt-1" href="{{ route('categories.index') }}">Published</a>
                    </li>
                    <li class="nav-item ml-2">
                        <a class="btn active btn-secondary mt-1" href="{{route('categories.trash')}}">Trash</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- Daftar category di sini --}}
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
                <h4>All Trashed Categories</h4>
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
                                <a href="{{ route('categories.restore', [$category->id]) }}"
                                    class="btn btn-success btn-sm">Restore
                                </a>
                                <form onsubmit="return confirm('Delete this category permanently?')" class="d-inline"
                                    action="{{ route('categories.delete-permanent', [$category->id]) }}" method="POST">
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
                        {{ $categories->appends(Request::all())->links() }}
                    </ul>
                </nav>
            </div>
            {{-- end pagination --}}
        </div>
    </div>
</div>


@endsection
@section('jslibraries')
<!-- JS Libraies -->
<script src="{{ asset('stisla/modules/jquery-ui/jquery-ui.min.js') }}"></script>
@endsection

@section('jspage')
<!-- Page Specific JS File -->
<script src="{{ asset('stisla/js/page/components-table.js') }}"></script>
@endsection