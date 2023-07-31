@php
    if(isset($color)) {
        $trashed = NULL;
        if($color->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($color->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $color->status->background_color }} label-roundless">{{ $color->status->name }}{{ $trashed }}</label>
@endif
