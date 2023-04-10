<div class="sidebar-content col-lg-3">
  <div class="row m-0">
    <div class="col-lg-12 mb-30 p-0">
      <div class="shadow-light card search p-15">
        <h6 class="text-uppercase mb-15">search</h6>
        <div class="search-oneline basic-form">
          <form>
            <input class="form-control" type="search" placeholder="Search here">
            <button type="submit"><i class="fas fa-search"></i></button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-12 mb-30 p-0">
      <div class="shadow-light card search p-15">
        <h6 class="text-uppercase mb-15">price filter</h6>
        <div class="price-range">
          <div class="price-output flex justify-content-between">
            <p>$<span class="price-from"></span></p>
            <p>$<span class="price-to"></span></p>
            <input type="number" min=0  name="min"  id="min_price" class="price-range-field" />
            <input type="number" min=0  name="max" id="max_price" class="price-range-field" />            
          </div>
          <div class="price-range-scale"></div>
        </div>
      </div>
    </div>

    <div class="col-lg-12 card p-0 mb-30">
      <div class="card p-15 shadow-light">
        <h6 class="text-uppercase mb-15">CATEGORIES</h6>
        <ul class="category">
          @foreach ($categories as $element)
            <?php $prod_count = DB::table('products')->where('category_id', $element->id)->count(); 
            if($prod_count > 0){
            ?>
          <li><a href="{{route('front.category', $element->slug)}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}">{{$element->name}} <span>{{ DB::table('products')->where('category_id', $element->id)->count() }}</span></a></li>
            <?php 
            }
            ?>
          @endforeach        
        </ul>
      </div>
    </div>
    @if (!empty($cat) && !empty(json_decode($cat->attributes, true)))
    @foreach ($cat->attributes as $key => $attr)
    <div class="col-lg-12 card p-0 mb-30">
      <div class="card p-15 shadow-light">
        <h6 class="text-uppercase mb-15">{{$attr->name}}</h6>
        <div class="brands">
        @if (!empty($attr->attribute_options))
          @foreach ($attr->attribute_options as $key => $option)          
          <div class="custom-control custom-checkbox mr-sm-2">
              <input type="checkbox" name="{{$attr->input_name}}[]" value="{{$option->name}}" class="custom-control-input attribute-input" id="{{$attr->input_name}}{{$option->id}}">
              <label class="custom-control-label" for="{{$attr->input_name}}{{$option->id}}">{{$option->name}}</label>
          </div>
          @endforeach
        @endif  
        </div>
      </div>
    </div>
    @endforeach
    @endif
  </div>
</div>