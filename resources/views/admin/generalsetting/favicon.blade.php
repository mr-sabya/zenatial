@extends('layouts.admin')
@section('title')
All Logo | {{ App\Models\Generalsetting::find(1)->site_name }}
@endsection

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
                All Logo
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
<div class="row">
    <div class="card">          
        <div class="card-body">
            @include('partials.message')
            <table class="table table-bordered">
                <thead>
                <tr role="row">
                    <th>Current Favicon</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="{{ $gs->favicon ? asset('assets/images/'.$gs->favicon):asset('assets/images/noimage.png')}}" alt=""></td>
                        <td>
                            <form action="{{ route('admin-gs-update') }}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <input class="img-upload1" type="file" name="favicon">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </td>
                    </tr>                
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