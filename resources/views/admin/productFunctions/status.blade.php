@php
    if(isset($productFunction)) {
        $trashed = NULL;
        if($productFunction->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($productFunction->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $productFunction->status->background_color }} label-roundless">{{ $productFunction->status->name }}{{ $trashed }}</label>
@endif
