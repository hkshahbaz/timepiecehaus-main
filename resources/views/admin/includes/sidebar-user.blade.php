
<!-- User menu -->
<div class="sidebar-user">
    <div class="category-content">
        <div class="media">
            <a href="#" class="media-left"><img src="{{ asset('admin/global_assets/images/placeholders/placeholder.jpg') }}" class="img-circle img-sm" alt=""></a>
            <div class="media-body">
                <span class="media-heading text-semibold">{{ auth()->user()->first_name}}</span>
                <div class="text-size-mini text-muted">
                    <i class="icon-pin text-size-small"></i> {{Auth::user()->roles()->first()->name}}
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /user menu -->
