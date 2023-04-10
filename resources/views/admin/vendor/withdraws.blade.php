@extends('layouts.admin')
@section('title')
Vendor Withdraws | {{ App\Models\Generalsetting::find(1)->site_name }}
@endsection

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
                Vendor Withdraws
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
                        <th width="180">Email</th>
                        <th width="180">Phone</th>
                        <th width="200">Amount</th>
                        <th width="200">Method</th>
                        <th width="250">Withdraw Date</th>
                        <th width="200">Status</th>
                        <th width="150">Action</th>                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($datas as $data)
                    <tr>
                        <td>{{ $data->user->email }}</td>
                        <td>{{ $data->user->phone }}</td>
                        <td>
                            <?php 
                            $sign = App\Models\Currency::where('is_default','=',1)->first();
                            $amount = $sign->sign.round($data->amount * $sign->value , 2);
                            ?>
                            {{ $amount }}                       
                        </td>
                        <td>{{ $data->method }}</td>
                        <td>{{ $data->created_at }}</td>
                        <td>{{ ucfirst($data->status) }}</td>
                        <td>
                            <div class="dropdown">
                                <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                    <a href="{{ route('admin-vendor-withdraw-show',$data->id) }}" class="dropdown-item">View Details</a>
                                    <a href="{{ route('admin-vendor-withdraw-accept',$data->id) }}" class="dropdown-item on-click">Accept</a>
                                    <a href="{{ route('admin-vendor-withdraw-reject',$data->id) }}" class="dropdown-item on-click">Reject</a>
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
@endsection