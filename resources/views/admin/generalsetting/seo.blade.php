@extends('layouts.admin')
@section('title')
Edit SEO Settings | {{ App\Models\Generalsetting::find(1)->site_name }}
@endsection

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
              Edit SEO Settings
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
                        <label>Meta Keywords</label><br>
                        <textarea class="form-control" name="meta_keys" placeholder="Meta Keywords">{{$gs->meta_keys}}</textarea>
                    </div>                  
                    <div class="form-group">
                        <label>Meta Description</label><br>
                        <textarea class="form-control" name="meta_desc" placeholder="Meta Description">{{$gs->meta_desc}}</textarea>
                    </div>                  
                    <div class="form-group">
                        <label>Google Analytics</label><br>
                        <textarea class="form-control" name="google_analytics" placeholder="Google Analytics">{{$gs->google_analytics}}</textarea>
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
  $(function () {
    // Summernote
    $('.editor').summernote()
  })
</script>
@endsection