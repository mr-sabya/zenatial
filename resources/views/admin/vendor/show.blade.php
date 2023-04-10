@extends('layouts.admin')

@section('title')
Vendor Information | {{ App\Models\Generalsetting::find(1)->site_name }}
@endsection

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
            Vendor Information
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="user-image">
                    @if($data->is_provider == 1)
                    <img style="width:220px; height:auto;" src="{{ $data->photo ? asset($data->photo):asset('assets/images/noimage.png')}}" alt="No Image">
                    @else
                    <img style="width:220px; height:auto;" src="{{ $data->photo ? asset('assets/images/users/'.$data->photo):asset('assets/images/noimage.png')}}" alt="No Image">                                            
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="table-responsive show-table">
                    <table>
                        <tr>
                            <th>Vendor ID#</th>
                            <td>{{$data->id}}</td>
                        </tr>
                        <tr>
                            <th>Store Name</th>
                            <td>{{ $data->shop_name }}</td>
                        </tr>
                        <tr>
                            <th>Owner Name</th>
                            <td>{{ $data->owner_name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $data->email }}</td>
                        </tr>
                        <tr>
                            <th>Shop Number</th>
                            <td>{{ $data->shop_number }}</td>
                        </tr>
                        <tr>
                            <th>Registration Number</th>
                            <td>{{ $data->reg_number }}</td>
                        </tr>

                        <tr>
                            <th>Shop Address</th>
                            <td>{{ $data->shop_address }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="table-responsive show-table">
                    <table>
                        <tr>
                            <th>Message</th>
                            <td>{{ $data->shop_message }}</td>
                        </tr>
                        <tr>
                            <th>Total Product(s)</th>
                            <td>{{ $data->products()->count() }}</td>
                        </tr>
                        <tr>
                            <th>Joined</th>
                            <td>{{ $data->created_at->diffForHumans() }}</td>
                        </tr>
                        <tr>
                            <th width="35%">Shop Details</th>
                            <td>{!! $data->shop_details !!}</td>
                        </tr>
                        <tr>
                            <td>
                                    @if($data->checkStatus())
                                    <a class="badge badge-success verify-link" href="javascript:;">Verified</a>
                                    <a class="set-gallery1" href="javascript:;" data-toggle="modal" data-target="#setgallery"><input type="hidden" value="{{ $data->verifies()->where('status','=','Verified')->first()->id }}">(View)</a>
                                    @else 
                                    <a class="badge badge-danger verify-link" href="javascript:;">Unverified</a>
                                    @endif
                            </td>
                            <td>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>    
    </div>
</div>

<div class="card">
    <div class="card-header">Products Added</div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data->products as $dt)
                <tr>
                <td><a href="{{ route('front.product', $dt->slug) }}" target="_blank">{{ sprintf("%'.08d",$dt->id) }}</a></td>
                    @php 
                    $stck = (string)$dt->stock;
                    if($stck == "0")
                    $stck = "Out Of Stock";
                    elseif($stck == null)
                    $stck = "Unlimited";
                    @endphp
                    <td>{{ $stck  }}</td>
                    <td>{{  App\Models\Product::convertPrice($dt->price) }}</td>
                    <td>
                        <div class="action-list">
                            <?php 
                            $class = $dt->status == 1 ? 'drop-success' : 'drop-danger';
                            $s = $dt->status == 1 ? 'selected' : '';
                            $ns = $dt->status == 0 ? 'selected' : '';                        
                            ?>
                            <select class="product-status-change form-control">
                                <option data-val="1" value="{{ route('admin-prod-status',['id1' => $dt->id, 'id2' => 1]) }}" {{ $s }}>Activated</option>
                                <option data-val="0" value="{{ route('admin-prod-status',['id1' => $dt->id, 'id2' => 0]) }}" {{ $ns }}>Deactivated</option>
                            </select> 
                        </div>
                    </td>
                    <td>
                        <a href=" {{ route('admin-prod-edit',$dt->id) }}" class="view-details">
                            Edit
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>        
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
</script>
@endsection