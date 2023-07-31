@isset($user)
    @if(!$user->trashed())
        <div class="btn-group btn-group-xs">
            <div class="btn-group users-btn">
                <button type="button" class="btn bg-slate-700 text-bold btn-xs user-detail"
                        onclick="getVendorDetail('{{$user->id}}')">Vendor Detail
                </button>
                <a href="{{ url('products?user_id='.$user->id) }}" class="btn bg-slate-700 text-bold btn-xs">View Products</a>
            </div>
        </div>
    @endif
@endisset
