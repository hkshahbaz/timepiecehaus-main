@php
    if(isset($dialFeature)) {
        $trashed = NULL;
        if($dialFeature->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($dialFeature->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $dialFeature->status->background_color }} label-roundless">{{ $dialFeature->status->name }}{{ $trashed }}</label>
@endif
