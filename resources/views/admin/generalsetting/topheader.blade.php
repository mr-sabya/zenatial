@extends('layouts.admin')
@section('title')
Edit Top Header Content | {{ App\Models\Generalsetting::find(1)->site_name }}
@endsection

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
              Edit Top Header Content
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">          
    <div class="card">          
    <div class="card-body">   
            @include('partials.message')         
                <form action="{{route('admin-gs-update')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}  
                    <div class="form-group">
                        <label>Welcome Text</label>
                        <input type="text" class="form-control" placeholder="Site Title" name="welcome_text" value="{{ $gs->welcome_text }}" required="">
                    </div>
                    <div class="form-group">
                        <label>Call Us No</label>
                        <input type="text" class="form-control" placeholder="Site Title" name="call_us_no" value="{{ $gs->call_us_no }}" required="">
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>   
            </div>  
        <!-- /.box-body -->     
    </div>
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
  $(function () {
    // Summernote
    $('.editor').summernote()
  })
</script>
@endsection