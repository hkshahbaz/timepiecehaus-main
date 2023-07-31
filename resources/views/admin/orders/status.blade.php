@php
    if(isset($order)) {
        $trashed = NULL;
        if($order->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($order->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $order->status->background_color }} label-roundless">{{ $order->status->name }}{{ $trashed }}</label>
@endif
