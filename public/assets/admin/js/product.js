(function($) {
		"use strict";
		
	$(document).ready(function() { 

        $('.showbox').hide();

        $(".toggle-checkboxn").click(function(){
            $(".showbox").toggle();
          });

        // Product Measure :)

        $("#product_measure").on( "change" ,function() {
            var val = $(this).val();
            $('#measurement').val(val);
            if(val == "Custom")
            {
            $('#measurement').val('');
              $('#measure').show();
            }
            else{
              $('#measure').hide();      
            }
        });

        // Product Measure Ends :)

	});

// TAGIT

          $("#metatags").tagit({
          fieldName: "meta_tag[]",
          allowSpaces: true 
          });

          $("#tags").tagit({
          fieldName: "tags[]",
          allowSpaces: true 
        });
// TAGIT ENDS


// Remove White Space


  function isEmpty(el){
      return !$.trim(el.html())
  }


// Remove White Space Ends

// Size Section

$("#size-btn").on('click', function(){

    $("#size-section").append(''+
                            '<div class="size-area">'+
                                '<span class="remove size-remove"><i class="fas fa-times"></i></span>'+
                                    '<div  class="row">'+
                                        '<div class="col-md-4 col-sm-6">'+
                                            '<label>'+
                                            'Size Name :'+
                                                '<span>(eg. S,M,L,XL,XXL)</span>'+
                                            '</label>'+
                                            '<input type="text" name="size[]" class="form-control" placeholder="Size Name">'+
                                        '</div>'+
                                        '<div class="col-md-4 col-sm-6">'+
                                            '<label>'+
                                            'Size Qty :'+
                                            '</label>'+
                                            '<input type="number" name="size_qty[]" class="form-control" placeholder="Size Qty" value="1" min="1">'+
                                        '</div>'+
                                        '<div class="col-md-4 col-sm-6">'+
                                            '<label>'+
                                            'Size Price :'+
                                            '</label>'+
                                            '<input type="number" name="size_price[]" class="form-control" placeholder="Size Price" value="0" min="0">'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'
                            +'');

});

$(document).on('click','.size-remove', function(){

    $(this.parentNode).remove();
    if (isEmpty($('#size-section'))) {

    $("#size-section").append(''+
                            '<div class="size-area">'+
                                '<span class="remove size-remove"><i class="fas fa-times"></i></span>'+
                                    '<div  class="row">'+
                                        '<div class="col-md-4 col-sm-6">'+
                                            '<label>'+
                                            'Size Name :'+
                                                '<span>(eg. S,M,L,XL,XXL)</span>'+
                                            '</label>'+
                                            '<input type="text" name="size[]" class="form-control" placeholder="Size Name">'+
                                        '</div>'+
                                        '<div class="col-md-4 col-sm-6">'+
                                            '<label>'+
                                            'Size Qty :'+
                                            '</label>'+
                                            '<input type="number" name="size_qty[]" class="form-control" placeholder="Size Qty" value="1" min="1">'+
                                        '</div>'+
                                        '<div class="col-md-4 col-sm-6">'+
                                            '<label>'+
                                            'Size Price :'+
                                            '</label>'+
                                            '<input type="number" name="size_price[]" class="form-control" placeholder="Size Price" value="0" min="0">'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'
                            +'');


    }

});

// Size Section Ends

// Type Check

$('#type_check').on('change',function(){
    var val = $(this).val();
    if(val == 1) {
    $('.row.file').css('display','flex');
    $('.row.file').find('input[type=file]').prop('required',true);
    $('.row.link').find('textarea').val('').prop('required',false);
    $('.row.link').hide();
    }
    else {
    $('.row.file').hide();
    $('.row.link').css('display','flex');
    $('.row.file').find('input[type=file]').prop('required',false);
    $('.row.link').find('textarea').prop('required',true);
    }

});

// Type Check Ends

})(jQuery);


  

