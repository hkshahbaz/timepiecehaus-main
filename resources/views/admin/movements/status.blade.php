@php
    if(isset($movement)) {
        $trashed = NULL;
        if($movement->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($movement->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $movement->status->background_color }} label-roundless">{{ $movement->status->name }}{{ $trashed }}</label>
@endif
