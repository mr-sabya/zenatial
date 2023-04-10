@extends('layouts.admin')
@section('title')
All Products | {{ App\Models\Generalsetting::find(1)->site_name }}
@endsection

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
                All Products
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
                            <input type="text" name="search" value="{{ Request::get('search') }}" class="form-control mr-2" placeholder="Search Customer" />
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
                <tr role="row">
                    <th>Name</th>
                    <th>Image</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($datas as $data)
                    <tr>
                        <td>
                            <p>
                            {{ $data->name }}
                            </p>
                            <p>
                                <small>ID: <a href="" target="_blank">{{ sprintf("%'.08d",$data->id) }}</a>
                                VENDOR: <a href="{{ route('admin-vendor-show',$data->user_id) }}" target="_blank">{{ $data->user->shop_name }}</a>
                                </small>

                            </p>
                        </td>
                        <td><img style="width:130px; height: auto;" src="{{ empty($data->photo) ? asset('assets/images/noimage.png') : filter_var($data->photo, FILTER_VALIDATE_URL) ? $data->photo : asset('assets/images/products/'.$data->photo) }}" alt=""></td>
                        <td>
                        @if($data->emptyStock())
                            Out of Stock
                        @else
                            {{ $data->stock }}
                        @endif
                        </td>
                        <td>
                        <?php 
                        $sign = App\Models\Currency::where('is_default','=',1)->first();
                        $price = round($data->price * $sign->value , 2);
                        ?>
                        {{ $sign->sign }}{{ $price }}</td>
                        <td width="151px">
                            <?php 
                            $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                            $s = $data->status == 1 ? 'selected' : '';
                            $ns = $data->status == 0 ? 'selected' : '';                        
                            ?>
                            <select class="product-status-change form-control">
                                <option data-val="1" value="{{ route('admin-prod-status',['id1' => $data->id, 'id2' => 1]) }}" {{ $s }}>Activated</option>
                                <option data-val="0" value="{{ route('admin-prod-status',['id1' => $data->id, 'id2' => 0]) }}" {{ $ns }}>Deactivated</option>
                            </select> 
                        </td>
                        <td>
                            <div class="dropdown">
                                <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                    <a href="{{ route('admin-prod-edit',$data->id) }}" class="dropdown-item">Edit</a>
                                    <a href="{{ route('admin-prod-delete',$data->id) }}" onClick="confirm('Are you sure you want to delete?')" class="dropdown-item">Delete</a>
                                </div>
                            </div>                        
                        </td>
                    </tr>
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
  $(document).on("change", ".product-status-change", function(){
    var to = $(this).val();
    $.ajax({
      url: to,
      type: "GET",
      dataType: "json"
    });    
  });
</script>
@endsection