<!-- our-brand-area start -->
<div class="our-brand-area section-pb mt-10 mb-10">
    <div class="container">
        <div class="row our-brand-active">
            @foreach($homeBrands as $homeBrand)
                <div class="brand-single-item">
                    <a href="{{ url('shop?brand='.$homeBrand->id) }}"><img src="{{ asset('admin/images/products/brands/'.$homeBrand->picture) }}" alt="{{ $homeBrand->name }}"></a>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- our-brand-area end -->
