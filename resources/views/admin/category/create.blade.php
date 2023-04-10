@extends('layouts.admin')

@section('pageheader')
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Create Category
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')

<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">   
            @include('partials.message')         
                <form action="{{route('admin-cat-create')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}  
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" id="cat-title" class="form-control" name="name" placeholder="Name of Category" required="" value="">
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" id="cat-slug" class="form-control" name="slug" placeholder="Slug" required="" value="">
                    </div>
                    <div class="form-group">
                        <label>Upload Icon</label>                    
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>                    
                    <button class="btn btn-primary" type="submit">Save</button>
                </form>   
            </div>   
        </div>   
    </div>
</div>
@endsection

@section('scripts')
<script>
$('body').on("input", '#cat-title', function() {
  var dInput = this.value;
  var slug = dInput.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
  $('#cat-slug').val(slug);
});
</script>
@endsection