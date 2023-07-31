<div class="row align-itmes-center">
    <div class="col">
        <!-- shop-top-bar start -->
        <div class="shop-top-bar">
            <!-- product-view-mode start -->

            <div class="product-mode">
                <!--shop-item-filter-list-->
                <!-- shop-item-filter-list end -->
            </div>
            <!-- product-view-mode end -->
            <!-- product-short start -->
            <div class="product-short">
                <p>Sort By :</p>
                @php
                    $sortBy =\Illuminate\Support\Facades\Request::get('sortBy');
                    $sortOrder =\Illuminate\Support\Facades\Request::get('sortOrder');

                    if($sortBy == ''){
                        $sortBy = 'name';
                        $sortOrder = 'asc';
                    }
                @endphp
                <select class="nice-select" id="shop-sort-by" name="sortby">
                    <option value="name-asc" @if( $sortBy=='name' &&  $sortOrder=='asc') selected @endif data-name="name" data-order="asc" >Name(A - Z)</option>
                    <option value="name-desc" @if( $sortBy=='name' && $sortOrder=='desc') selected @endif data-name="name" data-order="desc">Name(Z - A)</option>
                    <option value="price-asc" @if($sortBy=='price' && $sortOrder=='asc') selected @endif data-name="price" data-order="asc">Price(Low to High)</option>
                    <option value="price-desc" @if($sortBy=='price' && $sortOrder=='desc') selected @endif data-name="price" data-order="desc">Price(High to Low)</option>
                    <option value="rating-lowest" @if($sortBy=='rating' && $sortOrder=='asc') selected @endif data-name="rating" data-order="asc">Rating(Lowest)</option>
                    <option value="rating-highest" @if($sortBy=='rating' && $sortOrder=='desc') selected @endif data-name="rating" data-order="desc">Rating(Highest)</option>
                </select>
            </div>
            <!-- product-short end -->
        </div>
        <!-- shop-top-bar end -->
    </div>
</div>
