@extends('layouts.admin')



@section('pageheader')
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Edit Shipping
                <small>Update Shipping Method</small>
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
                <form action="{{route('admin-shipping-update',$data->id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}  
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" required="" value="{{ $data->title }}">
                    </div>
                    <div class="form-group">
                        <label>Estimated Time</label>
                        <input type="text" class="form-control" name="subtitle" placeholder="Duration" required="" value="{{ $data->subtitle }}">
                    </div>
                    <div class="form-group">
                        <label>Cost</label>
                        <input type="number" class="form-control" name="price" placeholder="{{ __('Price') }}" required="" value="{{ $data->price * $sign->value }}" min="0" step="0.01">
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>   
            </div>   
        </div>   
    </div>
</div>
@endsection