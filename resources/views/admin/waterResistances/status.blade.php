@php
    if(isset($waterResistance)) {
        $trashed = NULL;
        if($waterResistance->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($waterResistance->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $waterResistance->status->background_color }} label-roundless">{{ $waterResistance->status->name }}{{ $trashed }}</label>
@endif
