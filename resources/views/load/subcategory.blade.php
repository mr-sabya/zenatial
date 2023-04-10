@if(Auth::guard('admin')->check())

<option data-href="{{ route('admin-childcat-load',0) }}" value="">Select Sub Category</option>
@foreach($cat->subs as $sub)
<option data-href="{{ route('admin-childcat-load',$sub->id) }}" data-href2="{{ route('admin-prod-getattributes') }}?id={{ $sub->id }}&type=subcategory" value="{{ $sub->id }}">{{ $sub->name }}</option>
@endforeach

@else 

<option data-href="{{ route('admin-childcat-load',0) }}" value="">Select Sub Category</option>
@foreach($cat->subs as $sub)
<option data-href="{{ route('vendor-childcat-load',$sub->id) }}" data-href2="{{ route('admin-prod-getattributes') }}?id={{ $sub->id }}&type=subcategory" value="{{ $sub->id }}">{{ $sub->name }}</option>
@endforeach
@endif