@extends('layouts.admin')
@section('title')
All Categories | {{ App\Models\Generalsetting::find(1)->site_name }}
@endsection

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
                All Categories
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
                        <th width="200">Slug</th>
                        <th width="200">Attributes</th>
                        <th width="200">Status</th>
                        <th width="150">Action</th>                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($datas as $data)
                    <tr>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->slug }}</td>
                        <td>
                            <div class="action-list">
                                <a href="{{ route('admin-attr-createForCategory', $data->id) }}" class="btn attribute"><i class="fas fa-plus increase" aria-hidden="true"></i></a>
                                <?php 
                                if ($data->attributes()->count() > 0) {
                                    echo '<a href="' . route('admin-attr-manage', $data->id) .'?type=category' . '" class="btn edit"> <i class="fas fa-edit"></i></a>';
                                }
                                ?>
                            </div>
                        </td>
                        <td>
                        <?php 
                            $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                            $s = $data->status == 1 ? 'selected' : '';
                            $ns = $data->status == 0 ? 'selected' : '';                        
                        ?>
                            <select class="category-status-change form-control">
                                <option data-val="1" value="{{ route('admin-cat-status',['id1' => $data->id, 'id2' => 1]) }}" {{ $s }}>Activated</option>
                                <option data-val="0" value="{{ route('admin-cat-status',['id1' => $data->id, 'id2' => 0]) }}" {{ $ns }}>Deactivated</option>
                            </select>                         
                        </td>
                        <td>
                            <div class="dropdown">
                                <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                    <a href="{{ route('admin-cat-edit',$data->id) }}" class="dropdown-item">Edit</a>
                                    <a href="{{ route('admin-cat-delete',$data->id) }}" onclick="return confirm('Are you sure?')" class="dropdown-item">Delete</a>
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
<script>
  $(document).on("change", ".category-status-change", function(){
    var to = $(this).val();
    $.ajax({
      url: to,
      type: "GET",
      dataType: "json"
    });    
  });
</script>
@endsection