@extends('layouts.vendor')
@section('title')
All Orders | {{ App\Models\Generalsetting::find(1)->site_name }}
@endsection

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
                All Orders
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
<div class="row">
    <div class="card">
        <div class="card-header">
            <div class="clearfix">
                <div class="float-left">
                    <form action="" method="GET">
                        <div class="input-group">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                        </form>
                </div>
                <div class="float-right">
                    <div class="form-group" style="width:50px;">
                        <form action="{{ route('admin-order-index') }}" method="GET">
                            <input name="entries" id="per-page" type="text" class="form-control" value="{{ old('entries', $per_page) }}"  style="caret-color: #eaeaea;">
                        </form>
                    </div>
                </div>      
            </div>      
        </div>  
          
        <div class="card-body">
            @include('partials.message')
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="200">Order No</th>
                        <th width="200">Total Quantity</th>
                        <th width="150">Total Cost</th>
                        <th width="150">Payment Method</th>
                        <th width="150">Status</th>                     
                    </tr>
                </thead>
                <tbody>
                @foreach($datas as $orderr) 
                @php 
                    $qty = $orderr->sum('qty');
                    $price = $orderr->sum('price');                                       
                @endphp
                @foreach($orderr as $order)
                @php 
                if($user->shipping_cost != 0){
                    $price +=  round($user->shipping_cost * $order->order->currency_value , 2);
                }
                @endphp
<!--                 if(App\Models\Order::where('order_number','=',$order->order->order_number)->first()->tax != 0){
                    $price  += ($price / 100) * App\Models\Order::where('order_number','=',$order->order->order_number)->first()->tax;
                } -->
                <tr>
                    <td> <a href="{{route('vendor-order-invoice',$order->order_number)}}">{{ $order->order->order_number}}</a></td>
                    <td>{{$qty}}</td>
                    <td>{{$order->order->currency_sign}}{{round($price * $order->order->currency_value, 2)}}</td>
                    <td>{{$order->order->method}}</td>
                    <td>
                        <select class="form-control vendor-btn status-change {{ $order->status }}">
                            <option value="{{ route('vendor-order-status',['slug' => $order->order->order_number, 'status' => 'pending']) }}" {{  $order->status == "pending" ? 'selected' : ''  }}>Pending</option>
                            <option value="{{ route('vendor-order-status',['slug' => $order->order->order_number, 'status' => 'processing']) }}" {{  $order->status == "processing" ? 'selected' : ''  }}>Processing</option>
                            <option value="{{ route('vendor-order-status',['slug' => $order->order->order_number, 'status' => 'completed']) }}" {{  $order->status == "completed" ? 'selected' : ''  }}>Completed</option>
                            <option value="{{ route('vendor-order-status',['slug' => $order->order->order_number, 'status' => 'declined']) }}" {{  $order->status == "declined" ? 'selected' : ''  }}>Declined</option>
                        </select>                    
                    </td>                  
                </tr>
                @break
                @endforeach
                @endforeach
                </tbody>

            </table>
        </div>
        <!-- /.box-body -->
        <div class="card-footer clearfix">
            <div class="float-left">
                {{ $datas->appends(Request::query())->links() }}
            </div>
            <div class="float-right">
                <small>
                    <?php $datasCount = $datas->total() ?>
                    {{ $datasCount }} record(s)
                </small>
            </div>
        </div>      
    </div>
</div>

{{-- ORDER MODAL --}}


{{-- ADD / EDIT MODAL --}}

<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Delivery Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>

{{-- ADD / EDIT MODAL ENDS --}}

<div class="modal fade" id="confirm-delete1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="submit-loader">
            <img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
        </div>
        <div class="modal-header d-block text-center">
            <h4 class="modal-title d-inline-block">{{ __('Update Status') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p class="text-center">{{ __("You are about to update the order's Status.") }}</p>
        <p class="text-center">{{ __('Do you want to proceed?') }}</p>
        <input type="hidden" id="t-add" value="{{ route('admin-order-track-add') }}">
        <input type="hidden" id="t-id" value="">
        <input type="hidden" id="t-title" value="">
        <textarea class="input-field" placeholder="Enter Your Tracking Note (Optional)" id="t-txt"></textarea>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
            <a class="btn btn-success btn-ok order-btn">{{ __('Proceed') }}</a>
      </div>

    </div>
  </div>
</div>

{{-- ORDER MODAL ENDS --}}
@endsection
@section('scripts')
<script>
  $(document).on("change", ".status-change", function(){
    var to = $(this).val();
    $.ajax({
      url: to,
      type: "GET",
      dataType: "json"
    });    
  });
</script>
@endsection