@php
    if(isset($dialNumeral)) {
        $trashed = NULL;
        if($dialNumeral->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($dialNumeral->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $dialNumeral->status->background_color }} label-roundless">{{ $dialNumeral->status->name }}{{ $trashed }}</label>
@endif
