@extends('layouts.admin')

@section('pageheader')
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Create New Post
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
                <form action="{{route('admin-staff-create')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}  
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" required="" value="">
                    </div> 
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category_id" required="">
                            <option value="">Select Category</option>
                            @foreach($cats as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea class="form-control editor" name="policy"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Create</button>
                </form>   
            </div>   
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