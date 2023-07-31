@php
    if(isset($country)) {
        $trashed = NULL;
        if($country->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($country->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $country->status->background_color }} label-roundless">{{ $country->status->name }}{{ $trashed }}</label>
@endif
