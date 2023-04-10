@extends('layouts.admin')

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
                Edit Profile
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form id="geniusform" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}  
            <div class="row mb-3">
                <div class="col-md-6 offset-3">
                    @include('partials.message')
                </div> 
            </div>  
            <div class="row mb-3">
                <div class="col-md-2 offset-3 text-right"><strong>Profile Image</strong></div>
                <div class="col-md-4">
                    <div class="img-upload">
                        <div id="image-preview" class="img-preview">
                            <img src="{{ $data->photo ? asset('assets/images/admins/'.$data->photo):asset('assets/images/noimage.png') }}" /><br>
                            <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>Upload Image</label>
                            <input type="file" name="photo" class="img-upload" id="image-upload">
                        </div>
                    </div>            
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 offset-3 text-right"><strong>Name</strong></div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="name" placeholder="{{ __('User Name') }}" required="" value="{{$data->name}}">           
                </div>        
            </div>
            <div class="row mb-3">
                <div class="col-md-2 offset-3 text-right"><strong>Email</strong></div>
                <div class="col-md-4">
                    <input type="email" class="form-control" name="email" placeholder="{{ __('Email Address') }}" required="" value="{{$data->email}}">          
                </div>        
            </div>
            <div class="row mb-3">
                <div class="col-md-2 offset-3 text-right"><strong>Phone</strong></div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="phone" placeholder="{{ __('Phone Number') }}" required="" value="{{$data->phone}}">        
                </div>        
            </div>
            <div class="row mb-3">
                <div class="col-md-2 offset-3 text-right"><strong>Email</strong></div>
                <div class="col-md-4">
                    <input type="email" class="form-control" name="email" placeholder="{{ __('Email Address') }}" required="" value="{{$data->email}}">          
                </div>        
            </div>
            <div class="row mb-3">
                <div class="col-md-4 offset-6">
                    <button type="" class="btn btn-primary">Save</button>        
                </div>        
            </div>
        </form>
    </div>  
</div>
@endsection