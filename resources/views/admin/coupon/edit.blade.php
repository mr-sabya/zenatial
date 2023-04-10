@extends('layouts.admin')

@section('pageheader')
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Create Coupon
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
                <form action="{{route('admin-coupon-create')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}  
                    <div class="form-group">
                        <label>Code</label>
                        <input type="text" class="form-control" name="code" placeholder="Code" required="" value="{{$data->code}}">
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select id="type" class="form-control" name="type" required="">
                                <option value="">Select a type</option>
                                <option value="1" {{$data->type == 1 ? "selected":""}}>Amount</option>
                                <option value="0" {{$data->type == 0 ? "selected":""}}>Percentage</option>
                        </select>
                    </div>
                    <div id="amount" class="form-group">
                        <label>Amount</label>
                        <input id="amount-field" type="text" class="form-control" name="price" placeholder="$ Amount" required="" value="{{$data->price}}" {{$data->type == 1 ? "":"disabled"}}>
                    </div>                    
                    <div id="percentage" class="form-group">
                        <label>Pecentage</label>
                        <input id="percentage-field" type="text" class="form-control" name="price" placeholder="% Percentage" required="" value="{{$data->price}}" {{$data->type == 0 ? "":"disabled"}}>
                    </div>                    
                    <div class="form-group">
                        <label>Limitation</label>
                        <select id="times" class="form-control" required="">
                            <option value="0" {{$data->times == null ? "selected":""}}>Unlimited</option>
                            <option value="1" {{$data->times != null ? "selected":""}}>Limited</option>
                        </select>
                    </div>
                    <div id="quantity" class="form-group">
                        <label>Quantity</label>
                        <input id="quantity-field" type="text" class="form-control" name="times" placeholder="Quantity" required="" value="{{$data->times}}" {{$data->type == 1 ? "":"disabled"}}>
                    </div>
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" name="start_date" class="form-control" required="" value="{{$data->start_date}}">
                    </div>
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" name="end_date" class="form-control" required="" value="{{$data->end_date}}">
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>   
            </div>   
        </div>   
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){
    $('#amount, #percentage, #quantity').hide();
    var type = $('#type option').filter(':selected').val();
    var times = $('#times option').filter(':selected').val();
    if(type == 1){
        $('#amount').show(); 
    }
    if(type == 0){
        $('#percentage').show(); 
    }
    if(times == 1){
        $('#quantity').show(); 
    }
});

$('body').on('change', '#type', function(){
    if($(this).val() == 1){
        $('#amount').show();
        $('#amount-field').prop('disabled', false);
        $('#percentage').hide();
        $('#percentage-field').prop('disabled', true);
    }
    if($(this).val() == 0){
        $('#percentage').show();
        $('#percentage-field').prop('disabled', false);
        $('#amount').hide();
        $('#amount-field').prop('disabled', true);        
    }
    if($(this).val() == ""){
        $('#percentage').hide();
        $('#percentage-field').prop('disabled', true);
        $('#amount').hide();
        $('#amount-field').prop('disabled', true);        
    }
});
$('body').on('change', '#times', function(){
    if($(this).val() == 1){
        $('#quantity').show();
        $('#quantity-field').prop('disabled', false);
    }
    if($(this).val() == 0){
        $('#quantity').hide();
        $('#quantity-field').prop('disabled', true);
    }
});
</script>
@endsection