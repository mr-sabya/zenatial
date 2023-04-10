@extends('layouts.admin')
@section('title')
All {{ $type2 }} | {{ App\Models\Generalsetting::find(1)->site_name }}
@endsection

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
            All {{ $type2 }}
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
                  <a class="btn btn-primary" href="{{route('admin-banner-create', $type)}}">Add New {{ $type2 }} Banner</a>
                </div>      
            </div>      
        </div>     
        <div class="card-body">
            @include('partials.message')
            <table class="table table-bordered">
                <thead>
                <tr role="row">
                    <th>Featured Image</th>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($datas as $data)
                    <tr>
                        <td><img style="max-width:300px; height:auto;" src="{{ $data->photo ? url('assets/images/banners/'.$data->photo) : url('assets/images/noimage.png') }}" /></td>
                        <td>{{ $data->title }}</td>
                        <td>{{ $data->subtitle }}</td>
                        <td>
                            <div class="dropdown">
                                <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                    <a href="{{ route('admin-banner-edit',$data->id) }}" class="dropdown-item">Edit</a>
                                    <a href="{{ route('admin-banner-delete',$data->id) }}" onclick="return confirm('Are you sure?')" class="dropdown-item">Delete</a>
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