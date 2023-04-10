@extends('layouts.main-ecommerce')

@section('content')
<!-- Banner start -->
<section class="page-banner pt-150 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Reset Password</h2>
                    <nav class="breadcrumb">
                        <ul>
                            <li><a href="javascript:;">home</a></li>
                            <li><a href="javascript:;">login</a></li>
                            <li><a class="disabled" href="javascript:;">Reset Password</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner end -->

<!--Tracking start -->
<section class="tracking pt-120 pb-120">
    <div class="container tracking-container white-bg shadow-light pt-70 pb-70 pl-0 pr-0">
        <div class="col-lg-9 m-auto">
            <div class="tracking-text text-lg-center">
                <h2>Order tracking</h2>
                <p>To track your order please enter your Order Number in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                <div class="basic-form">
                    <form class="text-left col-lg-6 m-auto pt-50">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="order-id">Order Number</label>
                            <input type="text" class="form-control" id="order-id" placeholder="Found in your order confirmation email">
                        </div>
                        <button type="submit" class="btn">Track</button>
                    </form>
                    <div class="tracking-status"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Tracking end -->
@endsection

@section('scripts')
<script>
$("form").submit(function(e){
    e.preventDefault();
    var order_id = $('#order-id').val();
    var to = "{{ url('user/order/trackings/')  }}" + '/' + order_id;
    

    $.ajax({
      url: to,
      type: "GET",
      dataType: "text",
      success: function(r){
        $('.tracking-status').html(r);
      }
    });    
});
</script>
@endsection