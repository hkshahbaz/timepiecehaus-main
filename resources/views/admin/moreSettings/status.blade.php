@php
    if(isset($moreSetting)) {
        $trashed = NULL;
        if($moreSetting->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($moreSetting->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $moreSetting->status->background_color }} label-roundless">{{ $moreSetting->status->name }}{{ $trashed }}</label>
@endif
