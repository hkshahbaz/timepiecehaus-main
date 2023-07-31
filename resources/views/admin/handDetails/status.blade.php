@php
    if(isset($handDetail)) {
        $trashed = NULL;
        if($handDetail->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($handDetail->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $handDetail->status->background_color }} label-roundless">{{ $handDetail->status->name }}{{ $trashed }}</label>
@endif
