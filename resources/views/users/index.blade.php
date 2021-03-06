@extends("layouts.global")

@section("title") List Users @endsection

@section("content")
@section('pageTitle') List Users @endsection

{{-- Filter section --}}
<div class="row mb-4">
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-body">
                <ul class="nav nav-pills">
                    {{-- Create new user button --}}
                    <li class="nav-item">
                        <a href="{{ route('users.create') }}" class="btn btn-primary mt-1">
                            Create New user
                        </a>
                    </li>
                    {{-- Filtering by email and status --}}
                    <li class="nav-item ml-2">
                        <form action="{{route('users.index')}}">
                            <div class="custom-control custom-control-inline">
                                <input value="{{ Request::get('keyword') }}" name="keyword" class="form-control"
                                    type="text" placeholder="Insert email to filter..." />
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="active" name="status" class="custom-control-input"
                                    value="ACTIVE" {{Request::get('status') == 'ACTIVE' ? 'checked' : ''}}>
                                <label class="custom-control-label" for="active">Active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="inactive" name="status" class="custom-control-input"
                                    value="INACTIVE" {{Request::get('status') == 'INACTIVE' ? 'checked' : ''}}>
                                <label class="custom-control-label" for="inactive">Inactive</label>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-search"></i></button>
                            <a href="{{ route('users.index') }}" type="submit" class="btn btn-info">
                                RESET
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


{{-- List all users --}}
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
                <h4>All Users</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Avatar</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @php $no = $users->firstItem(); @endphp
                        @foreach($users as $user)
                        <tr>
                            <td scope="row">{{ $no }}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if($user->avatar)
                                <img src="{{asset('storage/'.$user->avatar)}}" width="50px">
                                @else
                                N/A
                                @endif
                            </td>
                            <td>
                                @if($user->status == "ACTIVE")
                                <span class="badge badge-success">
                                    {{$user->status}}
                                </span>
                                @else
                                <span class="badge badge-danger">
                                    {{$user->status}}
                                </span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('users.show', [$user->id])}}" class="btn btn-primary btn-sm">Detail</a>
                                <a href="{{ route('users.edit', [$user->id]) }}" class="btn btn-success btn-sm">Edit</a>

                                <form onsubmit="return confirm('Delete this user permanently?')" class="d-inline"
                                    action="{{route('users.destroy', [$user->id])}}" method="POST">
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
                        {{ $users->appends(Request::all())->links() }}

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