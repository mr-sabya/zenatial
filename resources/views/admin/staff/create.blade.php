@extends('layouts.admin')

@section('pageheader')
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Create New Staff
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
                <form action="{{route('admin-staff-create')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}  
                    <div class="form-group">
                        <label>Image Upload</label>
                        <input type="file" name="photo" class="img-upload" id="image-upload">
                    </div>                    
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" required="" value="">
                    </div>                    
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Email" required="" value="">
                    </div>                   
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="Phone" required="" value="">
                    </div>                   
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="role_id" required="">
                            <option value="">Select Role</option>
                            @foreach(DB::table('roles')->get() as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach                        
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" required="" value="">
                    </div>
                    <button class="btn btn-primary" type="submit">Create</button>
                </form>   
            </div>   
        </div>   
    </div>
</div>
@endsection