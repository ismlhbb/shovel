@extends("layouts.global")
@section("title") Edit Order @endsection

@section("content")
@section('pageTitle') Edit Order @endsection

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
        <form enctype="multipart/form-data" action="{{ route('orders.update', [$order->id]) }}" method="POST">
            @csrf
            <input type="hidden" value="PUT" name="_method">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Order</h4>
                </div>
                <div class="card-body">

                    {{-- Invoice number --}}
                    <div class="form-group">
                        <label for="invoice_number">Invoice number</label>
                        <input type="text" class="form-control" name="invoice_number" id="invoice_number"
                            value="{{$order->invoice_number}}" disabled>
                    </div>

                    {{-- buyer --}}
                    <div class="form-group">
                        <label>buyer</label>
                        <input type="text" class="form-control" value="{{$order->user->name}}" disabled>
                    </div>

                    {{-- Order date --}}
                    <div class="form-group">
                        <label for="created_at">Order Date</label>
                        <input type="text" class="form-control" value="{{$order->created_at}}" disabled>
                    </div>

                    {{-- Order date --}}
                    <div class="form-group">
                        <label for="">Books ({{ $order->totalQuantity }})</label>
                        <ul>
                            @foreach($order->books as $book)
                            <li>{{$book->title}} <b>({{$book->pivot->quantity}})</b></li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Order date --}}
                    <div class="form-group">
                        <label for="">Total Price</label>
                        <input type="text" class="form-control" value="{{ $order->total_price }}" disabled>
                    </div>

                    {{-- Status --}}
                    <div class="form-group">
                        <label for="status" class="d-block">Status</label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" {{$order->status == "SUBMIT" ? "checked" : ""}} id="submit"
                                name="status" class="custom-control-input" value="SUBMIT">
                            <label class="custom-control-label" for="submit">SUBMIT</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" {{$order->status == "PROCESS" ? "checked" : ""}} id="process"
                                name="status" class="custom-control-input" value="PROCESS">
                            <label class="custom-control-label" for="process">PROCESS</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" {{$order->status == "FINISH" ? "checked" : ""}} id="finish"
                                name="status" class="custom-control-input" value="FINISH">
                            <label class="custom-control-label" for="finish">FINISH</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" {{$order->status == "CANCEL" ? "checked" : ""}} id="cancel"
                                name="status" class="custom-control-input" value="CANCEL">
                            <label class="custom-control-label" for="cancel">CANCEL</label>
                        </div>
                    </div>

                    <input class="btn btn-primary" type="submit" value="Update">
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>

                </div>
            </div>
        </form>
    </div>
</div>

@endsection