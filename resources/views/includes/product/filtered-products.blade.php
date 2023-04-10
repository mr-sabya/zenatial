@if (count($prods) > 0)
	@foreach ($prods as $prod)
		@include('includes.product.grid-product')
	@endforeach
	<div class="col-lg-12">
		<div class="flex center-center w-100 pt-40">
			{!! $prods->appends(['search' => request()->input('search')])->links() !!}
		</div>
	</div>
@else
	<div class="col-lg-12">
		<div class="page-center">
				<h4 class="text-center">Sorry, there is no product!</h4>
		</div>
	</div>
@endif


@if(isset($ajax_check))


<script type="text/javascript">


// Tooltip Section


    $('[data-toggle="tooltip"]').tooltip({
      });
      $('[data-toggle="tooltip"]').on('click',function(){
          $(this).tooltip('hide');
      });




      $('[rel-toggle="tooltip"]').tooltip();

      $('[rel-toggle="tooltip"]').on('click',function(){
          $(this).tooltip('hide');
      });


// Tooltip Section Ends

</script>

@endif