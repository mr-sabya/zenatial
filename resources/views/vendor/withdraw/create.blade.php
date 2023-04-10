@extends('layouts.vendor')

@section('pageheader')
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Create Withdraw Request
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
                <form action="{{route('vendor-wt-store')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}  
                    <div class="form-group">
                        <label>Withdraw Method*</label>
                        <select class="form-control" name="methods" id="withmethod" required>
                            <option value="">Select Withdraw Method</option>
                            <option value="Cash from Office">Cash From Office</option>
                            <option value="bKash">bKash</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Withdraw Amount*</label>
                        <input name="amount" placeholder="Withdraw Amount" class="form-control"  type="text" value="{{ old('amount') }}" required>
                    </div>
                    <div class="form-group bkash-no" style="display:none;">
                        <input name="bkash_no" placeholder="bKash No" class="form-control" value="{{ old('bkash_no') }}" type="text">
                    </div>
                    <div class="form-group">
                        <label>Additional Reference</label>
                        <textarea class="form-control" name="reference" rows="6" placeholder="Reference">{{ old('reference') }}</textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>   
            </div>   
        </div>   
    </div>
</div>
@endsection

@section('scripts')
<script>
$('body').on('change', '#withmethod', function(){
    if($(this).val() == 'bKash'){
        $('.bkash-no').show();
    }else{
        $('.bkash-no').hide();
    }
});
</script>
@endsection