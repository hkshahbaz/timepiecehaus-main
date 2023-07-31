@php
    if(isset($braceletMaterial)) {
        $trashed = NULL;
        if($braceletMaterial->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($braceletMaterial->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $braceletMaterial->status->background_color }} label-roundless">{{ $braceletMaterial->status->name }}{{ $trashed }}</label>
@endif
