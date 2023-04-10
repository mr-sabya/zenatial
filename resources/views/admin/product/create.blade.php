@extends('layouts.admin')

@section('title')
Create Product | {{ App\Models\Generalsetting::find(1)->site_name }}
@endsection

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
                Create New Product
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->
@endsection

@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet" />

@endsection
@section('content')
<form id="product-upload" action="{{route('admin-prod-store')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    @include('partials.message')
                        <div class="col-lg-12">
                            <div class="left-area">
                                <label>Product Name* </label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" placeholder="Enter Product Name" name="name" required="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="left-area">
                                <label>Product Sku* </label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" placeholder="Enter Product Sku"
                                name="sku" required=""
                                value="{{ str_random(3).substr(time(), 6,8).str_random(3) }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="left-area">
                                <label>Category*</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <select id="cat" name="category_id" required="" class="form-control">
                                <option data-href="{{ route('admin-subcat-load',0) }}" value=" ">Select Category</option>
                                @foreach($cats as $cat)
                                <option data-href="{{ route('admin-subcat-load',$cat->id) }}" data-href2="{{ route('admin-prod-getattributes') }}?id={{ $cat->id }}&type=category" value="{{ $cat->id }}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row" id="subcat_row">
                        <div class="col-lg-12">
                            <div class="left-area">
                                <label>Sub Category*</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <select id="subcat" name="subcategory_id" class="form-control">
                                <option data-href="{{ route('admin-childcat-load',0) }}" value="">Select Sub Category</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" id="childcat_row">
                        <div class="col-lg-12">
                            <div class="left-area">
                                <label>Child Category*</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <select id="childcat" name="childcategory_id" class="form-control">
                                <option value="">Select Child Category</option>
                            </select>
                        </div>
                    </div>
                    <div id="catAttributes">                    
                    </div>
                    <div id="subcatAttributes"></div>
                    <div id="childcatAttributes"></div>

                    <div class="row">
                        <div class="col-lg-12">
                            <input class="toggle-checkbox" name="size_check" type="checkbox" id="size-check" value="1">
                            <label for="size-check">Allow Product Sizes</label>
                        </div>
                    </div>

                    <div id="size-row" class="row">
                        <div  class="col-lg-12">
                            <div class="product-size-details" id="size-section">
                                <div class="size-area">
                                    <span class="remove size-remove"><i class="fas fa-times"></i></span>
                                    <div  class="row">
                                        <div class="col-md-4 col-sm-6">
                                            <label>
                                            Size Name:
                                            <span>
                                            (eg. S,M,L,XL,XXL)
                                            </span>
                                            </label>
                                            <input type="text" name="size[]" class="form-control" placeholder="Size Name" disabled>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <label>
                                            Size Qty:
                                            </label>
                                            <input type="number" name="size_qty[]" class="form-control" placeholder="Size Qty" value="1" min="1" disabled>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <label>
                                            Size Price:
                                            </label>
                                            <input type="number" name="size_price[]" class="form-control" placeholder="Size Price" value="0" min="0" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="javascript:;" id="size-btn" class="btn btn-primary add-more mt-1">Add New Size</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <input class="checkclick1" name="color_check" type="checkbox" id="check3" value="1">
                            <label for="check3">Allow Product Colors</label>
                        </div>
                    </div>
                    <div id="color-row" class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Choose Product Color</label>

                                <div id="colorpicker" class="input-group my-colorpicker2 colorpicker-element" data-colorpicker-id="2">
                                    <input type="text" name="color[]" class="form-control" data-original-title="" title="" disabled>

                                    <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-square"></i></span>
                                    <span class="input-group-text color-remove"><i class="fas fa-window-close"></i></span>
                                    </div>
                                </div>
                                <a href="javascript:;" id="color-btn" class="btn btn-primary mt-2">Add New Color</a>
                            </div>                        
                        </div>                  
                    </div>
                    <div class="row" id="stckprod">
                        <div class="col-lg-12">
                            <div class="left-area">
                                <label>Product Stock*</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input name="stock" type="number" min="0" step="1" class="form-control" placeholder="e.g 20">
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="left-area">
                                <label>
                                    Product Description*
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="text-editor">
                                <textarea class="form-control editor" name="details" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="left-area">
                                <label>
                                    Product Buy/Return Policy*
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="text-editor">
                                <textarea class="form-control editor" name="policy"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <input class="checkclick1" name="seo_check" type="checkbox" id="seo_check" value="1">
                            <label for="check3">Allow Product SEO</label>
                        </div>
                    </div>
                    <div id="seo-row" class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Meta Keywords</label><br>
                                <textarea class="form-control" name="meta_tag" placeholder="Meta Keywords" disabled></textarea>
                            </div>                  
                            <div class="form-group">
                                <label>Meta Description</label><br>
                                <textarea class="form-control" name="meta_description" placeholder="Meta Description" disabled></textarea>
                            </div>                       
                        </div>                  
                    </div>                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="left-area">
                                <label>Feature Image *</label>
                            </div>
                        </div>
                    </div>
                    <input type="file" id="feature_photo" name="photo" value="">

                    <div class="row mb-4">
                        <div class="col-lg-12 mb-2">
                            <div class="left-area">
                                <label>
                                    Product Gallery Images *
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="file" name="gallery[]" class="hidden" id="uploadgallery" accept="image/*" multiple>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="left-area">
                                <label>
                                    Product Current Price*
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input name="price" type="number" class="form-control"
                                placeholder="e.g 20" step="0.01" required="" min="0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="left-area">
                                <label>Product Previous Price (Optional)</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input name="previous_price" step="0.01" type="number" class="form-control"
                                placeholder="e.g 20" min="0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary mt-3" type="submit">Create Product</button>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Image Gallery</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="top-area">
					<div class="row">
						<div class="col-sm-6 text-right">
							<div class="upload-img-btn">
								<label for="image-upload" id="prod_gallery"><i
										class="icofont-upload-alt"></i>Upload File</label>
							</div>
						</div>
						<div class="col-sm-6">
							<a href="javascript:;" class="upload-done" data-dismiss="modal"> <i
									class="fas fa-check"></i> Done</a>
						</div>
						<div class="col-sm-12 text-center">( <small>You can upload multiple Images.</small>
							)</div>
					</div>
				</div>
				<div class="gallery-images">
					<div class="selected-image">
						<div class="row">


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }} ">
<style>
#size-row, #color-row, #seo-row{
    display:none;
}
#product-upload label{
    margin: 15px 0;
}
.size-area{
    border: 1px solid #eee;
    padding: 20px;
    margin-top: 10px;
    position: relative;
}
.size-area label{
    font-size: 12px;
}
.size-area label span{
    font-size: 11px;
    font-weight: normal;
    font-color: #eee;
}
.size-remove{
    position: absolute;
    top: -2px;
    left: 4px;
}
#subcat_row, #childcat_row{
    display: none;
}

.my-colorpicker2{
    margin-top: 10px;
}

</style>
@endsection
@section('scripts')

<script src="{{asset('assets/admin/js/jquery.Jcrop.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.SimpleCropper.js')}}"></script>
<script src="{{asset('backend/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>

<script type="text/javascript">
	// Gallery Section Insert

	$(document).on('click', '.remove-img', function () {
		var id = $(this).find('input[type=hidden]').val();
		$('#galval' + id).remove();
		$(this).parent().parent().remove();
	});

	$(document).on('click', '#prod_gallery', function () {
		$('#uploadgallery').click();
		$('.selected-image .row').html('');
		$('#geniusform').find('.removegal').val(0);
	});


	$("#uploadgallery").change(function () {
		var total_file = document.getElementById("uploadgallery").files.length;
		for (var i = 0; i < total_file; i++) {
			$('.selected-image .row').append('<div class="col-sm-6">' +
				'<div class="img gallery-img">' +
				'<span class="remove-img"><i class="fas fa-times"></i>' +
				'<input type="hidden" value="' + i + '">' +
				'</span>' +
				'<a href="' + URL.createObjectURL(event.target.files[i]) + '" target="_blank">' +
				'<img src="' + URL.createObjectURL(event.target.files[i]) + '" alt="gallery image">' +
				'</a>' +
				'</div>' +
				'</div> '
			);
			$('#geniusform').append('<input type="hidden" name="galval[]" id="galval' + i +
				'" class="removegal" value="' + i + '">')
		}

	});

	// Gallery Section Insert Ends

    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $(this).find('.fa-square').css('color', event.color.toString());
    });
$(document).ready(function(){
    //$('#size-row').hide();
});
$('.cropme').simpleCropper();
$(function () {
    // Summernote
    $('.editor').summernote()
})
$("body").on("change", "#cat", function(){
    var href = $(this).find(':selected').data('href');
    var href2 = $(this).find(':selected').data('href2');
    $("#subcat_row").show();
    
    $.get(href, function( data ) {
        $("#subcat").html( data );
        $.get(href2, function(data2) {
            let attrHtml = '';
            for (var i = 0; i < data2.length; i++) {
            attrHtml += `
            <div class="row">
                <div class="col-md-12">
                    <label>${data2[i].attribute.name}</label>`;
                    for (var j = 0; j < data2[i].options.length; j++) {
                let priceClass = '';
                if (data2[i].attribute.price_status == 0) {
                priceClass = 'd-none';
                }
                attrHtml += `
                <div class="row">
                    <div class="col-md-4">
                        <label style="font-weight: normal; margin-top: 5px;">${data2[i].options[j].name}</label>
                    </div>
                    <div class="col-md-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <input type="checkbox" id="${data2[i].attribute.input_name}${data2[i].options[j].id}" name="${data2[i].attribute.input_name}[]" value="${data2[i].options[j].name}" class="attr-checkbox">
                                </span>
                            </div>
                            <input type="text" class="form-control price-input" id="${data2[i].attribute.input_name}${data2[i].options[j].id}_price" data-name="${data2[i].attribute.input_name}_price[]" placeholder="0.00 (Additional Price)" value="">
                        </div>
                    </div>
                </div>
                `;
            }

            attrHtml +=  `</div>
            </div>
            </div>
            `;
            }            
            $("#catAttributes").html(attrHtml);
            $("#subcatAttributes").html('');
            $("#childcatAttributes").html('');
        });
    });
});
$("body").on("change", "#subcat", function(){
    $("#childcat_row").show();
    var href = $(this).find(':selected').data('href');
    var href2 = $(this).find(':selected').data('href2');
    $.get(href, function( data ) {
        $("#childcat").html( data );
        $.get(href2, function(data2) {
            let attrHtml = '';
            for (var i = 0; i < data2.length; i++) {
            attrHtml += `
            <div class="row">
                <div class="col-md-12">
                    <label>${data2[i].attribute.name}</label>`;
                    for (var j = 0; j < data2[i].options.length; j++) {
                let priceClass = '';
                if (data2[i].attribute.price_status == 0) {
                priceClass = 'd-none';
                }
                attrHtml += `
                <div class="row">
                    <div class="col-md-4">
                        <label style="font-weight: normal; margin-top: 5px;">${data2[i].options[j].name}</label>
                    </div>
                    <div class="col-md-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <input type="checkbox" id="${data2[i].attribute.input_name}${data2[i].options[j].id}" name="${data2[i].attribute.input_name}[]" value="${data2[i].options[j].name}" class="attr-checkbox">
                                </span>
                            </div>
                            <input type="text" class="form-control price-input" id="${data2[i].attribute.input_name}${data2[i].options[j].id}_price" data-name="${data2[i].attribute.input_name}_price[]" placeholder="0.00 (Additional Price)" value="">
                        </div>
                    </div>
                </div>
                `;
            }

            attrHtml +=  `</div>
            </div>
            </div>
            `;
            }            
            $("#subcatAttributes").html(attrHtml);
            $("#childcatAttributes").html('');
        });
    });
});
$("body").on("change", "#childcat", function(){
    var href2 = $(this).find(':selected').data('href2');
    $.get(href2, function(data2) {
        let attrHtml = '';
        for (var i = 0; i < data2.length; i++) {
        attrHtml += `
        <div class="row">
            <div class="col-md-12">
                <label>${data2[i].attribute.name}</label>`;
                for (var j = 0; j < data2[i].options.length; j++) {
            let priceClass = '';
            if (data2[i].attribute.price_status == 0) {
            priceClass = 'd-none';
            }
            attrHtml += `
            <div class="row">
                <div class="col-md-4">
                    <label style="font-weight: normal; margin-top: 5px;">${data2[i].options[j].name}</label>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <input type="checkbox" id="${data2[i].attribute.input_name}${data2[i].options[j].id}" name="${data2[i].attribute.input_name}[]" value="${data2[i].options[j].name}" class="attr-checkbox">
                            </span>
                        </div>
                        <input type="text" class="form-control price-input" id="${data2[i].attribute.input_name}${data2[i].options[j].id}_price" data-name="${data2[i].attribute.input_name}_price[]" placeholder="0.00 (Additional Price)" value="">
                    </div>
                </div>
            </div>
            `;
        }

        attrHtml +=  `</div>
        </div>
        </div>
        `;
        }
        $("#childcatAttributes").html(attrHtml);
    });
});
$('body').on('change', '#size-check', function(){
    if($(this).is(":checked")){
        $('#size-row').show();
        $('.size-area input').prop('disabled', false);
        $('#stckprod').hide();
    }else{
        $('#size-row').hide();
        $('.size-area input').prop('disabled', true);
        $('#stckprod').show();  
    }
});
$('body').on('click', '#size-btn', function(){
    $("#size-section").clone().insertBefore(this);
});
$('body').on('click', '.size-remove', function(){
    if($('.size-remove').length > 1){
        $(this).closest('.product-size-details').remove();
    }
});

$('body').on('change', '#check3', function(){
    if($(this).is(":checked")){
        $('#color-row').show();
        $('.colorpicker-element input').prop('disabled', false);
    }else{
        $('#color-row').hide();
        $('.colorpicker-element input').prop('disabled', true);
    }
});

$('body').on('click', '#color-btn', function(){
    $("#colorpicker").clone().insertBefore(this);
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $(this).find('.fa-square').css('color', event.color.toString());
    });    
});

$('body').on('click', '.color-remove', function(){
    if($('.color-remove').length > 1){
        $(this).closest('.my-colorpicker2').remove();
    }
});

$('body').on('change', '#seo_check', function(){
    if($(this).is(":checked")){
        $('#seo-row').show();
        $('#seo-row textarea').prop('disabled', false);
    }else{
        $('#seo-row').hide();
        $('#seo-row textarea').prop('disabled', true);
    }
});
</script>
@endsection