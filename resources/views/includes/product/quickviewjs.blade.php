<script>
    $(document).on("click",".add-to-cart",function(){
        return $.get($(this).data("href"),
        function(e){
            "digital"==e?toastr.error('Already in cart'):0==e?toastr.error('Out of stock'):($("#cart-count").html(e[0]),
            toastr.success('Add to cart'))
        }
        ),!1})
    $(document).on("click",".add-to-wish",function(){return $.get($(this).data("href"),function(e){1==e[0]?(toastr.success('Add to wishlist'),$("#wishlist-count").html(e[1])):toastr.error('Already in wishlist')}),!1})
    


    $('.quick-view').on('click',function(){
    $('#quickview .modal-body').load($(this).data('href'),function(){
        $('#quickview .modal-header').hide();
        $('#quickview').modal({show:true});
    });
});
</script>