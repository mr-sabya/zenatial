@extends('layouts.admin')

@section('pageheader')
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Edit New Staff
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
                <form action="{{route('admin-staff-edit', $data->id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}  
                    <div class="form-group">
                        <img src="{{ $data->photo ? asset('assets/images/admins/'.$data->photo) : asset('assets/images/noimage.png') }}" style="width:130px; height:auto; border: 1px solid #eee; padding: 3px;" />
                        <br>
                        <label>Image Upload</label>
                        <input type="file" name="photo" class="img-upload" id="image-upload">
                    </div>                    
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" required="" value="{{ $data->name }}">
                    </div>                    
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Email" required="" value="{{ $data->email }}">
                    </div>                   
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="Phone" required="" value="{{ $data->phone }}">
                    </div>                   
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="role_id" required="">
                            <option value="">Select Role</option>
                            @foreach(DB::table('roles')->get() as $dta)
                            <option value="{{ $data->id }}" {{ $data->role_id == $dta->id ? 'selected' : '' }}>{{ $dta->name }}</option>
                            @endforeach                        
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" required="" value="">
                    </div>
                    <button class="btn btn-primary" type="submit">Edit</button>
                </form>   
            </div>   
        </div>   
    </div>
</div>
@endsection