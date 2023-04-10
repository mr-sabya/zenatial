@extends('layouts.admin')

@section('title')
Edit Attribute | {{ App\Models\Generalsetting::find(1)->site_name }}
@endsection

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
            Edit Attribute
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
                <form action="{{route('admin-attr-store')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" required="" value="{{$attr->name}}">
                    </div>
                    <div class="form-group">
                        <label>Option</label>
                        @foreach($attr->attribute_options() as $val)
                        <?php 
                        print_r($val);
                        ?>
                          @foreach($val as $val2)
                            <input type="text" class="form-control option" name="options[]" placeholder="Option Label" required="" value="">
                          @endforeach
                        @endforeach
                        <button class="btn btn-danger add-new mt-2">Add New</button>
                    </div>
                    <div class="form-check">    
                        <label for="priceStatus1"><input type="checkbox" id="priceStatus1" name="price_status" class="form-check-input" checked value="1">Allow Price Field</label>         
                    </div>
                    <div class="form-check">
                        <label for="priceStatus1"><input type="checkbox" id="priceStatus1" name="details_status" class="form-check-input" checked value="1">Show on Details Page</label>                    

                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>   
            </div>   
        </div>   
    </div>
</div>
</div>
@endsection

@section('scripts')
  <script>
  $('.form-group').on('click', '.add-new', function(){

  });
  var app = new Vue({
      el: '#app',
      data: {
        counter: 1
      },
      methods: {
        addOption() {
          $("#optionarea").addClass('d-block');
          this.counter++;
        },
        removeOption(n) {
          $("#counterrow"+n).remove();
          if ($(".counterrow").length == 0) {
            this.counter = 0;
          }
        }
      }
    })
  </script>
@endsection