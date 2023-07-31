@php
    if(isset($claspMaterial)) {
        $trashed = NULL;
        if($claspMaterial->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($claspMaterial->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $claspMaterial->status->background_color }} label-roundless">{{ $claspMaterial->status->name }}{{ $trashed }}</label>
@endif
