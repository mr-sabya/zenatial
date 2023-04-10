@extends('layouts.admin')
@section('title')
Edit SiteWide Content | {{ App\Models\Generalsetting::find(1)->site_name }}
@endsection

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
              Edit SiteWide Content
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">          
    <div class="card-body">
            @include('partials.message')         
                <form action="{{route('admin-gs-update')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}  
                    <div class="form-group">
                        <label>Website Title</label>
                        <input type="text" class="form-control" placeholder="Site Title" name="title" value="{{ $gs->title }}" required="">
                    </div>
                    <div class="form-group">
                        <label>Site Name</label>
                        <input type="text" class="form-control" placeholder="Site Name" name="site_name" value="{{ $gs->site_name }}" required="">
                    </div>
                    <div class="form-group">
                        <label>Withdraw Fee</label>
                        <input type="text" class="form-control" placeholder="Withdraw Fee" name="withdraw_fee" value="{{ $gs->withdraw_fee }}" required="">
                    </div>                    
                    <div class="form-group">
                        <label>Withdraw Charge</label>
                        <input type="text" class="form-control" placeholder="Withdraw Charge" name="withdraw_charge" value="{{ $gs->withdraw_charge }}" required="">
                    </div>                    
                    <div class="form-group">
                        <label>Tax</label>
                        <input type="text" class="form-control" placeholder="Tax" name="tax" value="{{ $gs->tax }}" required="">
                    </div>
                    <div class="form-group">
                        <label>Fixed Commission</label>
                        <input type="text" class="form-control" placeholder="Fixed Commission" name="fixed_commission" value="{{ $gs->fixed_commission }}" required="">
                    </div>
                    <div class="form-group">
                        <label>Percentage Commission</label>
                        <input type="text" class="form-control" placeholder="Percentage Commission" name="percentage_commission" value="{{ $gs->percentage_commission }}" required="">
                    </div>
                    <div class="form-group">
                      <label>Guest Checkout</label>
                      <select name="guest_checkout" class="form-control process select droplinks {{ $gs->guest_checkout == 1 ? 'drop-success' : 'drop-danger' }}">
                        <option data-val="1" value="1" {{ $gs->guest_checkout == 1 ? 'selected' : '' }}>{{ __('Activated') }}</option>
                        <option data-val="0" value="0" {{ $gs->guest_checkout == 0 ? 'selected' : '' }}>{{ __('Deactivated') }}</option>
                      </select>
                    </div>                   
                    <div class="form-group">
                      <label>Cash on Delivery</label>
                      <select name="cod_check" class="form-control process select droplinks {{ $gs->cod_check == 1 ? 'drop-success' : 'drop-danger' }}">
                        <option data-val="1" value="1" {{ $gs->cod_check == 1 ? 'selected' : '' }}>{{ __('Activated') }}</option>
                        <option data-val="0" value="0" {{ $gs->cod_check == 0 ? 'selected' : '' }}>{{ __('Deactivated') }}</option>
                      </select>
                    </div>                   
                    <div class="form-group">
                      <label>Display Stock Number</label>
                      <select name="show_stock" class="form-control process select droplinks {{ $gs->show_stock == 1 ? 'drop-success' : 'drop-danger' }}">
                        <option data-val="1" value="1" {{ $gs->show_stock == 1 ? 'selected' : '' }}>{{ __('Activated') }}</option>
                        <option data-val="0" value="0" {{ $gs->show_stock == 0 ? 'selected' : '' }}>{{ __('Deactivated') }}</option>
                      </select>
                    </div> 

                    <button class="btn btn-primary" type="submit">Update</button>
                </form>   
            </div>  
        <!-- /.box-body -->     
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
  $(document).on("change", ".product-status-change", function(){
    var to = $(this).val();
    $.ajax({
      url: to,
      type: "GET",
      dataType: "json"
    });    
  });
  $(function () {
    // Summernote
    $('.editor').summernote()
  })
</script>
@endsection