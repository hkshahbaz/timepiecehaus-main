@php
    if(isset($dial)) {
        $trashed = NULL;
        if($dial->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($dial->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $dial->status->background_color }} label-roundless">{{ $dial->status->name }}{{ $trashed }}</label>
@endif
