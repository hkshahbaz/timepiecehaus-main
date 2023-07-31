@isset($user)
    @if(!$user->trashed())
{{--        <a title="Edit" href="javascript:void(0)"><i class="icon-pencil4"></i></a>--}}
        <input type="hidden" id="delete-route-path" name="delete-route-path" value="{{ \Config::get('app.url').'/users' }}">
        <a title="Inactive" href="javascript:void(0)" class="delete-row" data-row-id="{{$user->id}}"><i class="icon-trash-alt text-danger"></i></a>
    @else
        <input type="hidden" id="restore-route-path" name="restore-route-path" value="{{ \Config::get('app.url').'/users/restore' }}">
        <a title="Restore" href="javascript:void(0)" class="restore-row" data-row-id="{{$user->id}}"><i class="icon-database-refresh text-success-800"></i></a>

        <input type="hidden" id="permanently-delete-route-path" name="permanently-delete-route-path" value="{{ \Config::get('app.url').'/users/permanentDelete' }}">
        <a title="Permanently Delete" href="javascript:void(0)" class="permanent-delete-row" data-row-id="{{$user->id}}"><i class="icon-trash text-danger-800"></i></a>
    @endif
@endisset
