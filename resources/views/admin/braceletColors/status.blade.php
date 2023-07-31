@php
    if(isset($braceletColor)) {
        $trashed = NULL;
        if($braceletColor->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($braceletColor->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $braceletColor->status->background_color }} label-roundless">{{ $braceletColor->status->name }}{{ $trashed }}</label>
@endif
