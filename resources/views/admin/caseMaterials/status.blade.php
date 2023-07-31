@php
    if(isset($caseMaterial)) {
        $trashed = NULL;
        if($caseMaterial->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($caseMaterial->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $caseMaterial->status->background_color }} label-roundless">{{ $caseMaterial->status->name }}{{ $trashed }}</label>
@endif
