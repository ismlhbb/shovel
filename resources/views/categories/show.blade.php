@extends("layouts.global")

@section("title") Detail Category @endsection

@section("content")
@section('pageTitle') Detail Category
@endsection

<div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card card-primary">
            <div class="card-header">
                <h4>Category ID: {{$category->id}}</h4>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><b>Category Name:</b><br>{{$category->name}}</li>
                    <li class="list-group-item"><b>Category Slug:</b><br>{{$category->slug}}</li>
                    <li class="list-group-item">
                        <b>Category Image:</b><br>
                        @if($category->image)
                        <img src="{{asset('storage/'. $category->image)}}" width="128px">
                        @else
                        No image
                        @endif </li>
                </ul>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection