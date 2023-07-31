@php
    if(isset($claspType)) {
        $trashed = NULL;
        if($claspType->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($claspType->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $claspType->status->background_color }} label-roundless">{{ $claspType->status->name }}{{ $trashed }}</label>
@endif
