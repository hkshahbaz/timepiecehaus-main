@php
    if(isset($language)) {
        $trashed = NULL;
        if($language->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($language->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $language->status->background_color }} label-roundless">{{ $language->status->name }}{{ $trashed }}</label>
@endif
