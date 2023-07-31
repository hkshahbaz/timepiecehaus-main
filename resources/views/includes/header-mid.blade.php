<!-- haeader Mid Start -->
<div class="haeader-mid-area bg-gren border-bm-1 d-none d-lg-block ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-5">
                <div class="logo-area">
                    <a href="{{ url('/') }}"><img src="{{ asset('admin/images/logo.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="search-box-wrapper">
                    <div class="search-box-inner-wrap">
                        @php
                            $brand =\Illuminate\Support\Facades\Request::get('brand');
                            if($brand == ''){
                                $brand = 0;
                            }
                            $name =\Illuminate\Support\Facades\Request::get('name');
                            if($name == NULL && $name = ''){
                                $name = '';
                            }
                        @endphp
                        <form method="GET" action="{{ route('shop.index') }}" class="search-box-inner">
                            <div class="search-select-box">
                                <select name="brand" id="brand" class="nice-select">
                                    <option value="0">All</option>
                                    @foreach($brands as $key => $value)
                                        <option value="{{ $key }}" @if($key == $brand) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="search-field-wrap">
                                <input type="text" name="name" id="name" class="search-field" value="{{$name}}"
                                       placeholder="Search watch...">
                                <div class="search-btn">
                                    <button type="submit"><i class="icon-magnifier"></i></button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="right-blok-box text-white d-flex">
                    <div class="user-wrap">
                        <a href="{{ route('wishList.index') }}"><span
                                class="cart-total">{{ $wishListItemsCount }}</span> <i
                                class="icon-heart"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- haeader Mid End -->
