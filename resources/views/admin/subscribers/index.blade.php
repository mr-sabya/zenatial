@extends('layouts.admin')
@section('title')
All Subscribers | {{ App\Models\Generalsetting::find(1)->site_name }}
@endsection

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
            All Subscribers
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
                  <a class="btn btn-primary" href="{{route('admin-subs-download')}}">Download List</a>
                </div>      
            </div>      
        </div>     
        <div class="card-body">
            @include('partials.message')
            <table class="table table-bordered">
                <thead>
                <tr role="row">
                    <th>#SL</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($datas as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->email }}</td>                        
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