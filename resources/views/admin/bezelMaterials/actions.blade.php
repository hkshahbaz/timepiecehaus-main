@isset($bezelMaterial)
    @if(!$bezelMaterial->trashed())
        <a title="Edit" href="{{ route('bezelMaterials.edit', [$bezelMaterial->id]) }}"><i class="icon-pencil4"></i></a>
        <input type="hidden" id="delete-route-path" name="delete-route-path" value="{{ \Config::get('app.url').'/bezelMaterials' }}">
        <a title="Inactive" href="javascript:void(0)" class="delete-row" data-row-id="{{$bezelMaterial->id}}"><i class="icon-trash-alt text-danger"></i></a>
    @else
        <input type="hidden" id="restore-route-path" name="restore-route-path" value="{{ \Config::get('app.url').'/bezelMaterials/restore' }}">
        <a title="Restore"  class="restore-row" href="javascript:void(0)" data-row-id="{{$bezelMaterial->id}}"><i class="icon-database-refresh text-success-800"></i></a>

        <input type="hidden" id="permanent-delete-route-path" name="permanent-delete-route-path" value="{{ \Config::get('app.url').'/bezelMaterials/permanentDelete' }}">
        <a title="Permanently Delete" class="permanent-delete-row" href="javascript:void(0)" data-row-id="{{$bezelMaterial->id}}"><i class="icon-trash text-danger-800"></i></a>
    @endif
@endisset
