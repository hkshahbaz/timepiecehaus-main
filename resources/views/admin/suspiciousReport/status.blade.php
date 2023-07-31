@php
    if(isset($suspiciousReport)) {
        $trashed = NULL;
        if($suspiciousReport->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($suspiciousReport->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $suspiciousReport->status->background_color }} label-roundless">{{ $suspiciousReport->status->name }}{{ $trashed }}</label>
@endif
