@extends('layouts.admin')



@section('pageheader')
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Edit Order
                <small>Update Delivery Status</small>
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')

<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">   
            @include('partials.message')         
                <form action="{{route('admin-order-update',$data->id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}  
                    <div class="form-group">
                        <label for="payment_status">Payment Status</label>
                        <select name="payment_status" class="form-control" id="payment_status" required="">
                            <option value="Pending" {{$data->payment_status == 'Pending' ? "selected":""}}>Unpaid</option>
                            <option value="Completed" {{$data->payment_status == 'Completed' ? "selected":""}}>Paid</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Delivery Status</label>
                        <select name="status" class="form-control" id="status" required="">
                            <option value="pending" {{ $data->status == "pending" ? "selected":"" }}>Pending</option>
                            <option value="processing" {{ $data->status == "processing" ? "selected":"" }}>Processing</option>
                            <option value="on delivery" {{ $data->status == "on delivery" ? "selected":"" }}>On Delivery</option>
                            <option value="completed" {{ $data->status == "completed" ? "selected":"" }}>Completed</option>
                            <option value="declined" {{ $data->status == "declined" ? "selected":"" }}>Declined</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="track_text">Track Note</label>
                            <textarea name="track_text" class="form-control" id="track_text" rows="3" placeholder="Track Order"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>   
            </div>   
        </div>   
    </div>
</div>
@endsection