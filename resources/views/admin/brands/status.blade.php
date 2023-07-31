@php
    if(isset($brand)) {
        $trashed = NULL;
        if($brand->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($brand->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $brand->status->background_color }} label-roundless">{{ $brand->status->name }}{{ $trashed }}</label>
@endif
