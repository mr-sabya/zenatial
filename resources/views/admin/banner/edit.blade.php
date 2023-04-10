@extends('layouts.admin')

@section('pageheader')
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Edit Banner
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
                <form action="{{route('admin-banner-update', $data->id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}  
                    <div class="form-group">
                        <label>Image</label>
                        <img style="width: 200px; height: auto;" src="{{ $data->photo ? asset('assets/images/banners/'.$data->photo):asset('assets/images/noimage.png') }}" />
                        <br>
                    </div>
                    <div class="form-group">
                        <label>Image Upload</label>
                        <input type="file" name="photo" class="img-upload" id="image-upload">
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $data->title }}" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label>Subtitle</label>
                        <input type="text" class="form-control" name="subtitle" value="{{ $data->subtitle }}" placeholder="Subtitle">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" value="{{ $data->description }}" placeholder="Description">
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input type="text" class="form-control" name="link" value="{{ $data->link }}" placeholder="http://example.com">
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>   
            </div>   
        </div>   
    </div>
</div>
@endsection