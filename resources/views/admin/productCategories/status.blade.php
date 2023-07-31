@php
    if(isset($productCategory)) {
        $trashed = NULL;
        if($productCategory->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($productCategory->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $productCategory->status->background_color }} label-roundless">{{ $productCategory->status->name }}{{ $trashed }}</label>
@endif
