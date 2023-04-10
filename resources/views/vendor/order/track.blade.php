@extends('layouts.vendor')

@section('pageheader')
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Add Tracking Status
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
                <input type="hidden" id="track-store" value="{{route('admin-order-track-store')}}">      
                <form action="{{route('admin-order-track-store')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="order_id" value="{{ $data->id }}">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <textarea name="title" class="form-control" id="title" rows="3" placeholder="Title"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="track-details">Track Note</label>
                            <textarea name="text" class="form-control" id="track-details" rows="3" placeholder="Details"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>   
            </div>   
        </div>   
    </div>
</div>
@endsection