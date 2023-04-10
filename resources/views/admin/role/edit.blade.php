@extends('layouts.admin')

@section('pageheader')
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Edit Role
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
                <form action="{{route('admin-role-edit', $data->id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}  
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" required="" value="{{ $data->name }}">
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" {{ $data->sectionCheck('orders') ? 'checked' : '' }} value="orders">Orders</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" {{ $data->sectionCheck('products') ? 'checked' : '' }} value="products">Products</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" {{ $data->sectionCheck('customers') ? 'checked' : '' }} value="customers">Customers</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" {{ $data->sectionCheck('vendors') ? 'checked' : '' }} value="vendors">Vendors</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" {{ $data->sectionCheck('categories') ? 'checked' : '' }} value="categories">Categories</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" {{ $data->sectionCheck('product_discussion') ? 'checked' : '' }} value="product_discussion">Product Discussion</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" {{ $data->sectionCheck('set_coupons') ? 'checked' : '' }} value="set_coupons">Set Coupons</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" {{ $data->sectionCheck('blog') ? 'checked' : '' }} value="blog">Blog</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" {{ $data->sectionCheck('general_settings') ? 'checked' : '' }} value="general_settings">General Settings</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" {{ $data->sectionCheck('home_page_settings') ? 'checked' : '' }} value="home_page_settings">Home Page Settings</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" {{ $data->sectionCheck('menu_page_settings') ? 'checked' : '' }} value="menu_page_settings">Menu Page Settings</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" {{ $data->sectionCheck('payment_settings') ? 'checked' : '' }} value="payment_settings">Payment Settings</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" {{ $data->sectionCheck('social_settings') ? 'checked' : '' }} value="social_settings">Social Settings</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" {{ $data->sectionCheck('seo_tools') ? 'checked' : '' }} value="seo_tools">Seo Tools</label>         
                    </div>
                    <div class="form-check">    
                        <label>
                        <input type="checkbox" name="section[]" class="form-check-input" {{ $data->sectionCheck('subscribers') ? 'checked' : '' }} value="subscribers">Subscribers</label>         
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>   
            </div>   
        </div>   
    </div>
</div>
@endsection