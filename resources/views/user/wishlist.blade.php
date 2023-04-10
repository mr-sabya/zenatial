@extends('layouts.main-ecommerce')

@section('content')
<!-- Banner start -->
<section class="page-banner pt-150 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Wishlist</h2>
                    <nav class="breadcrumb">
                        <ul>
                            <li><a href="javascript:;">home</a></li>
                            <li><a href="javascript:;">user</a></li>
                            <li><a class="disabled" href="javascript:;">Wishlists</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner end -->

<!-- Whish-list start -->
<section class="whish-list-page pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-details table-responsive">
                <?php 
                if(!empty($sort)){
                ?>
                    <table class="table">
                        <thead class="shadow-light">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stoke status</th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($wishlists as $wishlist)
                            <tr class="pb-30 pt-30">
                                <td scope="row">
                                    <a class="item-remove" href="javascript:;" data-href="{{ route('user-wishlist-remove',$wishlist->id) }}"><i class="far fa-trash-alt"></i></a>
                                </td>
                                <td><img class="w-25 img-fluid" src="{{ $wishlist->product->photo ? asset('assets/images/products/'.$wishlist->product->photo):asset('assets/images/noimage.png') }}" alt="card-img">
                                </td>
                                <td>								
                                    <a href="{{ route('front.product', $wishlist->product->slug) }}">
								    {{ $wishlist->product->name }}
								    </a>
                                </td>
                                <td>{{ $wishlist->product->showPrice() }}<small><del>{{ $wishlist->product->showPreviousPrice() }}</del></small></td>
                                <td class="counting">
                                    <p class="stoke-status-in">
                                    @if($wishlist->product->emptyStock())
                                        <p class="stoke-status-out">out of stock</p>
                                    @else
                                        <p class="stoke-status-in">In stock</p>
                                    @endif
                                </td>
                                <td>{{ $wishlist->product->showPrice() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                <?php 
                }else{
                    ?>
                    <h3 class="mt-1 text-left">No item(s) in your Wishlists.</h3>
                    <br>
                    <a class="btn" href="{{ URL::previous() }}">Back</a>
                    <?php
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Whish-list end -->
@endsection

@section('scripts')
<script>
  $(document).on("click", ".item-remove", function(){
    $(this).closest("tr").remove();
    var to = $(this).data("href");
    $.ajax({
      url: to,
      type: "GET",
      dataType: "json",
      success: function(r){
        if(r[1] == 0){
          $(".card-details").html('<h3 class="mt-1 pl-3 text-left">No item(s) in your Wishlists.</h3>');
        }
      }
    });    
  });
</script>
@endsection