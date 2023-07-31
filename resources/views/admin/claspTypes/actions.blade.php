@isset($claspType)
    @if(!$claspType->trashed())
        <a title="Edit" href="{{ route('claspTypes.edit', [$claspType->id]) }}"><i class="icon-pencil4"></i></a>
        <input type="hidden" id="delete-route-path" name="delete-route-path" value="{{ \Config::get('app.url').'/claspTypes' }}">
        <a title="Inactive" href="javascript:void(0)" class="delete-row" data-row-id="{{$claspType->id}}"><i class="icon-trash-alt text-danger"></i></a>
    @else
        <input type="hidden" id="restore-route-path" name="restore-route-path" value="{{ \Config::get('app.url').'/claspTypes/restore' }}">
        <a title="Restore"  class="restore-row" href="javascript:void(0)" data-row-id="{{$claspType->id}}"><i class="icon-database-refresh text-success-800"></i></a>

        <input type="hidden" id="permanent-delete-route-path" name="permanent-delete-route-path" value="{{ \Config::get('app.url').'/claspTypes/permanentDelete' }}">
        <a title="Permanently Delete" class="permanent-delete-row" href="javascript:void(0)" data-row-id="{{$claspType->id}}"><i class="icon-trash text-danger-800"></i></a>
    @endif
@endisset
