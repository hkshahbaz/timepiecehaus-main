@php
    if(isset($deliveryScope)) {
        $trashed = NULL;
        if($deliveryScope->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($deliveryScope->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $deliveryScope->status->background_color }} label-roundless">{{ $deliveryScope->status->name }}{{ $trashed }}</label>
@endif
