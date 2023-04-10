@extends('layouts.admin')
@section('title')
All Coupons | {{ App\Models\Generalsetting::find(1)->site_name }}
@endsection

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
            All Coupons
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
                </div>
                <div class="float-right">
                  <a class="btn btn-primary" href="{{route('admin-coupon-create')}}">Add New Coupon</a>
                </div>      
            </div>      
        </div>     
        <div class="card-body">
            @include('partials.message')
            <table class="table table-bordered">
                <thead>
                <tr role="row">
                    <th>Code</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Used</th>
                    <th>Status</th>
                    <th>Expiry</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($datas as $data)
                    <tr>
                        <td>{{ $data->code }}</td>
                        <td>
                        <?php 
                        $type = $data->type == 0 ? "Percentage" : "Amount";
                        ?>
                        {{ $type }}
                        </td>
                        <td>
                        <?php 
                        $price = $data->type == 0 ? $data->price .'%' : '$' . $data->price;
                        ?>
                        {{ $price }}</td>
                        <td>{{ $data->used }}</td>
                        <td>
                        <?php 
                        $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                        $s = $data->status == 1 ? 'selected' : '';
                        $ns = $data->status == 0 ? 'selected' : '';                        
                        ?>  
                        <select class="status-change form-control">
                            <option data-val="1" value="{{ route('admin-coupon-status',['id1' => $data->id, 'id2' => 1]) }}" {{ $s }}>Activated</option>
                            <option data-val="0" value="{{ route('admin-coupon-status',['id1' => $data->id, 'id2' => 0]) }}" {{ $ns }}>Deactivated</option>
                        </select>                                               
                        </td>
                        <td>{{ $data->end_date }}</td>
                        <td>
                            <div class="dropdown">
                                <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                    <a href="{{ route('admin-coupon-edit',$data->id) }}" class="dropdown-item">Edit</a>
                                    <a href="{{ route('admin-coupon-delete',$data->id) }}" onclick="return confirm('Are you sure?')" class="dropdown-item">Delete</a>
                                </div>
                            </div>                        
                        </td>                         
                    </tr>
                    @endforeach
                
                </tbody>

            </table>
        </div>
        <!-- /.box-body -->     
    </div>
</div>
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