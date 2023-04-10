@extends('layouts.admin')
@section('title')
Edit Social Links | {{ App\Models\Generalsetting::find(1)->site_name }}
@endsection

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
              Edit Social Links
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
                        <label>Facebook</label><br>
                        <input type="text" class="form-control" placeholder="Facebook" name="facebook" value="{{ $gs->facebook }}">
                    </div>                                   
                    <div class="form-group">
                        <label>Twitter</label><br>
                        <input type="text" class="form-control" placeholder="Twitter" name="twitter" value="{{ $gs->twitter }}">
                    </div>                                   
                    <div class="form-group">
                        <label>Instagram</label><br>
                        <input type="text" class="form-control" placeholder="Instagram" name="instagram" value="{{ $gs->instagram }}">
                    </div>                                   
                    <div class="form-group">
                        <label>YouTube</label><br>
                        <input type="text" class="form-control" placeholder="YouTube" name="youtube" value="{{ $gs->youtube }}">
                    </div>                                   
                    <div class="form-group">
                        <label>Linkedin</label><br>
                        <input type="text" class="form-control" placeholder="Linkedin" name="linkedin" value="{{ $gs->linkedin }}">
                    </div>                                   
                    <div class="form-group">
                        <label>Appstore</label><br>
                        <input type="text" class="form-control" placeholder="Appstore" name="appstore" value="{{ $gs->appstore }}">
                    </div>                                   
                    <div class="form-group">
                        <label>Playstore</label><br>
                        <input type="text" class="form-control" placeholder="Playstore" name="playstore" value="{{ $gs->playstore }}">
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