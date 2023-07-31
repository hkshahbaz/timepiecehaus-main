@php
    if(isset($condition)) {
        $trashed = NULL;
        if($condition->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($condition->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $condition->status->background_color }} label-roundless">{{ $condition->status->name }}{{ $trashed }}</label>
@endif
