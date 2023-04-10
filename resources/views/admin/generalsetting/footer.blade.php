@extends('layouts.admin')
@section('title')
Edit Footer | {{ App\Models\Generalsetting::find(1)->site_name }}
@endsection

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
              Edit Footer
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
                        <label>Footer Text</label>
                        <textarea class="form-control editor"  name="footer" required=""> {{ $gs->footer }} </textarea>
                    </div>
                    <div class="form-group">
                        <label>Copyright Text</label><br>
                        <textarea class="form-control editor"  name="copyright" required=""> {{ $gs->copyright }} </textarea>
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