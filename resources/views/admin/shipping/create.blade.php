@extends('layouts.admin')

@section('pageheader')
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Create Shipping Method
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
                <form action="{{route('admin-shipping-create')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}  
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" required="" value="">
                    </div>
                    <div class="form-group">
                        <label>Estimated Time</label>
                        <input type="text" class="form-control" name="subtitle" placeholder="Duration" required="" value="">
                    </div>
                    <div class="form-group">
                        <label>Cost</label>
                        <input type="number" class="form-control" name="price" placeholder="Price" required="" value="" min="0" step="0.01">
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>   
            </div>   
        </div>   
    </div>
</div>
@endsection