@extends('layouts.admin')

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
                Change Password
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form id="geniusform" action="{{ route('admin.password.update') }}" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}
            <div class="row mb-3">
                <div class="col-md-6 offset-3">
                    @include('partials.message')
                </div> 
            </div>
            <div class="row mb-3">
                <div class="col-md-2 offset-3 text-right"><strong>Current Password</strong></div>
                <div class="col-md-4">
                    <input type="password" class="form-control" name="cpass" placeholder="Enter Current Password" required="" value="">        
                </div>        
            </div>
            <div class="row mb-3">
                <div class="col-md-2 offset-3 text-right"><strong>New Password</strong></div>
                <div class="col-md-4">
                    <input type="password" class="form-control" name="newpass" placeholder="Enter New Password" required="" value="">
                </div>        
            </div>
            <div class="row mb-3">
                <div class="col-md-2 offset-3 text-right"><strong>Confirm Password</strong></div>
                <div class="col-md-4">
                    <input type="password" class="form-control" name="renewpass" placeholder="{{ __('Re-Type New Password') }}" required="" value="">       
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