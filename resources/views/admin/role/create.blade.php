@extends('layouts.admin')

@section('pageheader')
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Create New Role
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
                <form action="{{route('admin-role-create')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}  
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" required="" value="">
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" value="orders">Orders</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" value="products">Products</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" value="customers">Customers</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" value="vendors">Vendors</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" value="categories">Categories</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" value="product_discussion">Product Discussion</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" value="set_coupons">Set Coupons</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" value="blog">Blog</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" value="general_settings">General Settings</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" value="home_page_settings">Home Page Settings</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" value="menu_page_settings">Menu Page Settings</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" value="payment_settings">Payment Settings</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" value="social_settings">Social Settings</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" value="seo_tools">Seo Tools</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" value="subscribers">Subscribers</label>         
                    </div>
                    <button class="btn btn-primary" type="submit">Create</button>
                </form>   
            </div>   
        </div>   
    </div>
</div>
@endsection