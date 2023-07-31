@php
    if(isset($glassType)) {
        $trashed = NULL;
        if($glassType->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($glassType->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $glassType->status->background_color }} label-roundless">{{ $glassType->status->name }}{{ $trashed }}</label>
@endif
