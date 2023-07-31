@if($products->count() > 0)
    @foreach($products as $key => $product)
        @php
            $statuses3 = arrayCopy($statuses->toArray());
        @endphp
        <!-- list item -->
        <li class="media panel panel-body stack-media-on-mobile">
            @php
                if($product->productPictures()->count()){
                    if(file_exists('admin/images/products/'.$product->productPictures()->first()->picture)){
                        $pic = asset('admin/images/products/'.$product->productPictures()->first()->picture);
                    }
                    else{
                        $pic = asset('admin/images/default-watch-picture.gif');
                    }
                }else{
                    $pic = asset('admin/images/default-watch-picture.gif');
                }
            @endphp
            <a href="{{ $pic }}" class="media-left"
               data-popup="lightbox">
                <img src="{{ $pic }}" width="96"
                     alt="">
            </a>
            <div class="media-body">
                <h6 class="media-heading text-semibold">
                    <a href="#" data-product-id="{{ $product->id }}" id="productName">{{ ucfirst($product->name) }}</a>
                </h6>

                <ul class="list-inline list-inline-separate mb-10">
                    <li><a href="#" class="text-muted" product-brand-id="{{$product->brand_id}}"
                           id="productBrand">{{$product->brand->name}}</a></li>
                    <li><a href="#" class="text-muted" data-product-category-id="{{ $product->product_category_id }}"
                           id="productCategory">
                            {{ $product->productCategory->name }}
                        </a></li>
                </ul>

                <p class="content-group-sm text-justify" id="description">
                    {{ substrwords($product->description, 500) }}<a
                        href="{{ route('products.show', [$product->id]) }}">Read More</a>
                </p>

                <ul class="list-inline list-inline-separate">
                    <li>Vendor: <a href="#" data-vendor-id="{{ $product->user_id }}"
                                   id="userId">{{ucfirst($product->vendor->getFullName()) ?? ''  }}</a></li>
                    <li class="pull-right">
                        <label
                            class="label label-roundless {{ $product->is_draft ? 'label-danger' : 'label-success' }}">{{ $product->is_draft ? 'Drafted' : 'Completed' }}</label>
                    </li>
                    @if(!is_null($product->status))
                        <li class="pull-right mr-5 product{{$product->id}}">
                            <label
                                class="label label-roundless {{ $product->status->background_color }}">{{ $product->status->name }}</label>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="media-right text-center">
                <h3 class="no-margin text-semibold" id="price">{{$product->currency->symbol ?? ' '}}{{ $product->price }}</h3>
                @php
                    $count = $product->productRatings()->count();
                    $avgRating = round($product->productRatings()->avg('rating'), 1);
                    $total = 5;
                    $diff = $total - $avgRating;
                    $difff = fmod($avgRating,1);
                @endphp
                <div class="text-nowrap">
                    @for($i=1; $i <= $total; $i++)
                        @if($i <= $avgRating)
                            <i class="icon-star-full2 text-size-base text-warning-300"></i>
                        @elseif($difff > 0 && $difff < 1)
                            <i class="icon-star-half text-size-base text-warning-300"></i>
                            @php $difff = round($difff, 0) @endphp
                        @else
                            <i class="icon-star-empty3 text-size-base text-warning-300"></i>
                        @endif
                    @endfor
                </div>
                <div class="text-muted" id="noOfReviews">{{ $count }} reviews</div>
                @php
                    unset($statuses3[$product->status_id]);
                @endphp
                {!! Form::select('status_id', $statuses3, NULL, ['class' => 'status_id select', 'onchange' => 'updateProductStatus('.$product->id.',this.value)']) !!}
                <a href="{{ route('products.show', [$product->id]) }}" class="btn bg-teal-400 mt-15">View Detail<i
                        class="fa fa-arrow-right position-right"></i>
                </a>
            </div>
        </li>
        <!-- /list item -->
    @endforeach
@else
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="text-bold">No Watch Found!</h1>
        </div>
    </div>
@endif
