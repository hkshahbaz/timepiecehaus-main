@php
    if(isset($productType)) {
        $trashed = NULL;
        if($productType->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($productType->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $productType->status->background_color }} label-roundless">{{ $productType->status->name }}{{ $trashed }}</label>
@endif
