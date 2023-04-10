@extends('layouts.admin')
@section('title')
Edit Newsletter | {{ App\Models\Generalsetting::find(1)->site_name }}
@endsection

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
                Newsletter Edit
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
                        <label>Newsletter Title</label>
                        <input type="text" class="form-control" placeholder="Popup Title" name="popup_title" value="{{ $gs->popup_title }}" required="">
                    </div>
                    <div class="form-group">
                        <label>Newsletter Text</label><br>
                        <textarea class="form-control editor"  name="popup_text" placeholder="Popup Text">{{$gs->popup_text}}</textarea>
                    </div>
                    <div class="form-group">
                        <img src="{{ $gs->popup_background ? asset('assets/images/'.$gs->popup_background):asset('assets/images/noimage.png') }}" style="width:250px;height:auto; border: 2px solid #e5e5e5; padding:2px;" />
                        <input type="file" name="popup_background" class="img-upload" id="image-upload">
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