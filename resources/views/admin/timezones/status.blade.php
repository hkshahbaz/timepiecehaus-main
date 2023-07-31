@php
    if(isset($timezone)) {
        $trashed = NULL;
        if($timezone->trashed())
            $trashed = ' - DELETED';
        else
            $trashed = NULL;
    }
@endphp
@if(is_null($timezone->status))
    <label class="label lable-default label-roundless">Not Set</label>
@else
    <label class="label {{ $timezone->status->background_color }} label-roundless">{{ $timezone->status->name }}{{ $trashed }}</label>
@endif

{{--@php--}}
{{--    if(isset($timezone)) {--}}
{{--        $trashed = NULL;--}}
{{--        if($timezone->trashed())--}}
{{--            $trashed = ' - DELETED';--}}
{{--        else--}}
{{--            $trashed = NULL;--}}
{{--    }--}}
{{--@endphp--}}
{{--@if(is_null($timezone->status))--}}
{{--    <label class="label lable-default label-roundless">Not Set</label>--}}
{{--@else--}}
{{--    @if(!isset($timezone->status->name))--}}
{{--        <label--}}
{{--            class="label {{ $timezone->background_color }} label-roundless">{{ $timezone->name }}{{ $trashed }}</label>--}}
{{--    @else--}}
{{--        <label--}}
{{--            class="label {{ $timezone->status->background_color }} label-roundless">{{ $timezone->status->name }}{{ $trashed }}</label>--}}
{{--    @endif--}}
{{--@endif--}}
