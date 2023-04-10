@extends('layouts.admin')
@section('title')
All Product Reports | {{ App\Models\Generalsetting::find(1)->site_name }}
@endsection

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
                All Product Reports
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
                        <th width="200">Name</th>
                        <th width="200">Subject</th>
                        <th width="200">Message</th>
                        <th width="200">Date</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datas as $data)
                    <tr>
                        <td>{{ $data->user->name }}</td>
                        <td>{{ $data->subject }}</td>
                        <td>{{ $data->message }}</td>
                        <td>{{ $data->created_at->diffForHumans() }}</td>
                        <td>
                            <div class="dropdown">
                                <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                    <a href="{{ route('admin-message-show',$data->id) }}" class="dropdown-item">View Details</a>
                                    <a href="{{ route('admin-message-delete',$data->id) }}" onclick="return confirm('Are you sure?')" class="dropdown-item">Delete</a>
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


@section('scripts')

@endsection