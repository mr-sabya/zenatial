@if(isset($order))
<div class="delivery-tracking text-left">
    <div class="timeline mt-50 bg-white p-30 pt-50 pb-50 shadow-light">
        <ul>
        @foreach($order->tracks as $track)
            <li class="{{ in_array($track->title, $datas) ? 'starting' : '' }}">
                <i class="fas fa-check"></i>
                <h6>{{ ucwords($track->title)}}</h6>
                <p>{{ date('d m Y',strtotime($track->created_at)) }}</p>
                <p>{{ $track->text }}</p>
            </li>
        @endforeach
        </ul>
    </div>
</div>
@else 
<h3 class="text-center">No Order Found</h3>
@endif          