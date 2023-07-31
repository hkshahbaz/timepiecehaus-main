<!-- Main navigation -->
<div class="sidebar-category sidebar-category-visible">
    <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">
            <!-- Main -->
            <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
            <li class="{{ Request::is(['dashboard']) ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>

            <!-- User Management -->
            <li class="{{ Request::is(['users/*', 'users']) ? 'active' : '' }}">
                <a href="{{ route('users.index') }}"><i class="icon-user-tie"></i> <span>Vendor Management</span></a>
            </li>
            <!-- /User Management -->

            <!-- Product Management -->
            <li>
                <a href="javascript:void(0)"><i class="fa fa-product-hunt"></i> <span>Product Management</span></a>
                <ul>
                    <li class="{{ Request::is(['products/*', 'products']) ? 'active' : '' }}">
                        <a href="{{ route('products.index') }}">Product List</a>
                    </li>
                    <li class="{{ Request::is(['productTypes/*', 'productTypes']) ? 'active' : '' }}">
                        <a href="{{ route('productTypes.index') }}">Product Types Management</a>
                    </li>
                    <li class="{{ Request::is(['productFunctions/*', 'productFunctions']) ? 'active' : '' }}">
                        <a href="{{ route('productFunctions.index') }}">Product Functions Management</a>
                    </li>
                    <li class="{{ Request::is(['productCategories/*', 'productCategories']) ? 'active' : '' }}">
                        <a href="{{ route('productCategories.index') }}">Product Category Management</a>
                    </li>
                </ul>
            </li>
            <!-- /Product Management -->

            <!-- Order Management -->
            <li class="{{ Request::is(['orders', 'orders/*']) ? 'active' : '' }}"><a href="{{ route('orders.index') }}"><i class="fa fa-first-order"></i> <span>Orders Management</span></a></li>
            <!-- /Order Management -->

            <!-- Product Settings -->
            <li>
                <a href="javascript:void(0)"><i class="icon-gear"></i> <span>Product Settings</span></a>
                <ul>
                    <li class="{{ Request::is(['brands/*', 'brands']) ? 'active' : '' }}">
                        <a href="{{ route('brands.index') }}">
                            Brand Management
                        </a>
                    </li>
                    <li class="{{ Request::is(['conditions/*', 'conditions']) ? 'active' : '' }}">
                        <a href="{{ route('conditions.index') }}">Conditions Management</a>
                    </li>
                    <li class="{{ Request::is(['deliveryScopes/*', 'deliveryScopes']) ? 'active' : '' }}">
                        <a href="{{ route('deliveryScopes.index')}}">Delivery of Scopes Management</a>
                    </li>
                    <li class="{{ Request::is(['movements/*', 'movements']) ? 'active' : '' }}">
                        <a href="{{ route('movements.index')}}">Movement Management</a>
                    </li>
                    <li class="{{ Request::is(['bezelMaterials/*', 'bezelMaterials']) ? 'active' : '' }}">
                        <a href="{{ route('bezelMaterials.index')}}">Bezel Materials Management</a>
                    </li>
                    <li class="{{ Request::is(['braceletColors/*', 'braceletColors']) ? 'active' : '' }}">
                        <a href="{{ route('braceletColors.index')}}">Bracelet Colors Management</a>
                    </li>
                    <li class="{{ Request::is(['braceletMaterials/*', 'braceletMaterials']) ? 'active' : '' }}">
                        <a href="{{ route('braceletMaterials.index')}}">Bracelet Material Management</a>
                    </li>
                    <li class="{{ Request::is(['glassTypes/*', 'glassTypes']) ? 'active' : '' }}">
                        <a href="{{route('glassTypes.index')}}">Glass Types Management</a>
                    </li>
                    <li class="{{Request::is(['waterResistances/*','waterResistances']) ? 'active' : ''}}">
                        <a href="{{ route ('waterResistances.index')}}">Water Resistance Management</a>
                    </li>
                    <li class="{{ Request::is(['caseMaterials/*', 'caseMaterials']) ? 'active' : '' }}">
                        <a href="{{ route('caseMaterials.index') }}">Case Materials Management</a>
                    </li>
                    <li class="{{ Request::is(['moreSettings/*', 'moreSettings']) ? 'active' : '' }}"><a href="{{ route('moreSettings.index') }}">More Setting Management</a></li>
                    <li class="{{ Request::is(['dials/*', 'dials']) ? 'active' : '' }}">
                        <a href="{{ route('dials.index') }}">Dial Management</a>
                    </li>
                    <li class="{{ Request::is(['dialNumerals/*', 'dialNumerals']) ? 'active' : '' }}">
                        <a href="{{ route('dialNumerals.index') }}">Dial Numerals Management</a>
                    </li>
                    <li class="{{ Request::is(['dialFeatures/*', 'dialFeatures']) ? 'active' : '' }}">
                        <a href="{{ route('dialFeatures.index') }}">Dial Features Management</a>
                    </li>
                    <li class="{{ Request::is(['handDetails/*', 'handDetails']) ? 'active' : '' }}">
                        <a href="{{ route('handDetails.index') }}">Hand Details Management</a>
                    </li>
                    <li class="{{ Request::is(['claspMaterials/*', 'claspMaterials']) ? 'active' : '' }}">
                        <a href="{{ route('claspMaterials.index') }}">Clasp Material Management</a>
                    </li>
                    <li class="{{ Request::is(['claspTypes/*', 'claspTypes']) ? 'active' : '' }}">
                        <a href="{{ route('claspTypes.index') }}">Clasp Types Management</a>
                    </li>


                </ul>
            </li>
            <!-- /Product Settings -->

            <!-- Settings -->
            <li>
                <a href="javascript:void(0)"><i class="icon-cogs"></i> <span>Settings</span></a>
                <ul>
                    <li class="{{ Request::is(['statuses/*', 'statuses']) ? 'active' : '' }}"><a href="{{ route('statuses.index') }}">Status Management</a></li>
                    <li class="{{ Request::is(['languages/*', 'languages']) ? 'active' : '' }}"><a href="{{ route('languages.index') }}">Language Management</a></li>
                    <li class="{{ Request::is(['countries/*', 'countries']) ? 'active' : '' }}"><a href="{{ route('countries.index') }}">Countries Management</a></li>
                    <li class="{{ Request::is(['timezones/*', 'timezones']) ? 'active' : '' }}"><a href="{{ route('timezones.index') }}">Timezone Management</a></li>
                    <li class="{{ Request::is(['settings/*', 'settings']) ? 'active' : '' }}"><a href="{{ route('settings.index') }}">Site Settings</a></li>
                </ul>
            </li>
            <!-- /Settings -->

            <!-- Reports -->
            <li>
                <a href="javascript:void(0)"><i class="icon-pen"></i> <span>Reports</span></a>
                <ul>
                    <li class="{{ Request::is(['suspiciousReport/*', 'suspiciousReport']) ? 'active' : '' }}"><a href="{{route('suspiciousReport.index')}}">Suspicious Reports</a></li>
                </ul>
            </li>
            <!-- /Reports -->
        </ul>
    </div>
</div>
<!-- /main navigation -->
