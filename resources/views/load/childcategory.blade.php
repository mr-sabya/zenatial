<option value="">Select Child Category</option>
@foreach($subcat->childs as $child)
<option data-href2="{{ route('admin-prod-getattributes') }}?id={{ $child->id }}&type=childcategory" value="{{ $child->id }}">{{ $child->name }}</option>
@endforeach