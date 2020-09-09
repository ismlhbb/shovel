@extends("layouts.global")

@section("title") List Orders @endsection

@section("content")
@section('pageTitle') List Orders @endsection

{{-- Filter section --}}
<div class="row mb-4">
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-body">
                <ul class="nav nav-pills">
                    {{-- Filtering by email and status --}}
                    <li class="nav-item">
                        <form action="{{ route('orders.index') }}">
                            <div class="custom-control custom-control-inline">
                                <input value="{{ Request::get('buyer_email') }}" name="buyer_email" class="form-control"
                                    type="text" placeholder="Search by buyer email" />
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="submit" name="status" class="custom-control-input"
                                    value="SUBMIT" {{ Request::get('status') == 'SUBMIT' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="submit">Submit</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="Process" name="status" class="custom-control-input"
                                    value="PROCESS" {{ Request::get('status') == 'PROCESS' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="Process">Process</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="finish" name="status" class="custom-control-input"
                                    value="FINISH" {{ Request::get('status') == 'FINISH' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="finish">Finish</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="cancel" name="status" class="custom-control-input"
                                    value="CANCEL" {{ Request::get('status') == 'CANCEL' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="cancel">Cancel</label>
                            </div>
                            <button type="submit" value="Filter" class="btn btn-primary mr-2">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('orders.index') }}" type="submit" class="btn btn-info">
                                RESET
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- List all orders --}}
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
                <h4>All Orders</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <tr>
                            <th>#</th>
                            <th>Invoice</th>
                            <th>Status</th>
                            <th>Buyer</th>
                            <th>Total Quantity</th>
                            <th>Order Date</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                        @php $no = $orders->firstItem(); @endphp
                        @foreach($orders as $order)
                        <tr>
                            <td scope="row">{{ $no }}</td>
                            <td>{{$order->invoice_number}}</td>
                            <td>
                                @if($order->status == "SUBMIT")
                                <span class="badge badge-warning">
                                    {{$order->status}}
                                </span>
                                @elseif($order->status == "PROCESS")
                                <span class="badge badge-info">
                                    {{$order->status}}
                                </span>
                                @elseif($order->status == "FINISH")
                                <span class="badge badge-success">
                                    {{$order->status}}
                                </span>
                                @elseif($order->status == "CANCEL")
                                <span class="badge badge-dark">
                                    {{$order->status}}
                                </span>
                                @endif
                            </td>
                            <td>
                                {{$order->user->name}} <br>
                                <small>{{$order->user->email}}</small>
                            </td>
                            <td>{{$order->totalQuantity}} pc (s)</td>
                            <td>{{$order->created_at}}</td>
                            <td>{{$order->total_price}}</td>
                            <td>
                                <a href="{{ route('orders.edit', [$order->id]) }}" class="btn btn-success btn-sm">
                                    Edit
                                </a>
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
                        {{ $orders->appends(Request::all())->links() }}
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