@php
    if(isset($bezelMaterial)) {
        $trashed = NULL;
        if($bezelMaterial->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($bezelMaterial->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $bezelMaterial->status->background_color }} label-roundless">{{ $bezelMaterial->status->name }}{{ $trashed }}</label>
@endif
