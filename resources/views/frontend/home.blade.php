@extends('layouts.frontend')
@section('title', 'Trang chủ')

@section('content')
<section>

<div id="bannerCarousel" class="carousel slide container mt-4 mb-grid-gutter" data-bs-ride="carousel">
    @foreach ($banner as $vl )
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div style="background-color: #f8f9fa; border-radius: .25rem; padding: 2rem;">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div style="padding-left: 1rem; padding-right: 1rem;">
                            <span style="background-color: #dc3545; color: #fff; padding: .5rem 1rem; border-radius: .25rem;">Khuyến mãi đặc biệt</span>
                            <h3 style="margin-top: 1rem; margin-bottom: .25rem; color: #212529; font-weight: 300;">Sản phẩm mới 100%</h3>
                            <h2 style="margin-bottom: .25rem;">{{$vl->tieude}}</h2>
                            <p style="font-size: 1.25rem; color: #212529; font-weight: 300;">Số lượng sản phẩm có hạn!</p>
                            <a class="btn btn-accent" href="#" style="background-color: #ff6600; color: #fff; padding: .5rem 1rem; border-radius: .25rem;">Xem chi tiết<i class="ci-arrow-right fs-ms ms-1"></i></a>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <img src="{{ env('APP_URL') . '/storage/app/' . $vl->hinhanh}}" style="width: 100%;" >
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev" style="background-color: rgba(0, 0, 0, 0.5); border-radius: .25rem;">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next" style="background-color: rgba(0, 0, 0, 0.5); border-radius: .25rem;">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
</section>

<section class="container">
    <div class="tns-carousel border-end">
        <div class="tns-carousel-inner"
            data-carousel-options="{ &quot;nav&quot;: false, &quot;controls&quot;: false, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 4000, &quot;loop&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;360&quot;:{&quot;items&quot;:2},&quot;600&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
            @foreach ($hangsanxuat as $vl )
            
            <div>
                <a class="d-block bg-white border py-4 py-sm-5 px-2" href="{{ route('frontend.sanpham.phanloaiNSX', ['tenhang_slug' => $vl->tenhang_slug]) }}" style="margin-right:-.0625rem;">
                    <img class="d-block mx-auto" src="{{ env('APP_URL') . '/storage/app/' . $vl->hinhanh }}" style="width:165px;" />
                </a>
            </div>
            @endforeach
           
        </div>
    </div>
</section>

    @foreach($loaisanpham as $lsp)
    <section class="container pt-3 pb-2">
        <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
            <h2 class="h3 mb-0 pt-3 me-2">{{ $lsp->tenloai }}</h2>
            <div class="pt-3">
                <a class="btn btn-outline-accent btn-sm"
                    href="{{ route('frontend.sanpham.phanloai', ['tenloai_slug' => $lsp->tenloai_slug]) }}">Xem tất cả<i
                        class="ci-arrow-right ms-1 me-n1"></i>
                </a>
            </div>
        </div>
        <div class="row pt-2 mx-n2">
            @foreach($lsp->SanPham->take(8) as $sp)
            <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
                <div class="card product-card">
                    <a class="card-img-top d-block overflow-hidden"
                        href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => $lsp->tenloai_slug, 'tensanpham_slug' => $sp->tensanpham_slug]) }}">
                        <img src="{{ env('APP_URL') . '/storage/app/' . $sp->hinhanh }}" />
                    </a>
                    <div class="card-body py-2">
                        <a class="product-meta d-block fs-xs pb-1" href="#">{{ $lsp->tenloai }}</a>
                        <h3 class="product-title fs-sm">
                            <a
                                href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => $lsp->tenloai_slug, 'tensanpham_slug' => $sp->tensanpham_slug]) }}">{{
                                $sp->tensanpham }}</a>
                        </h3>
                        <div class="d-flex justify-content-between">
                            <div class="product-price">
                                <span class="text-accent">{{ number_format($sp->dongia, 0, ',', '.')
                                    }}<small>đ</small></span>
                            </div>
                            <div class="star-rating">
                                <i class="star-rating-icon ci-star-filled active"></i>
                                <i class="star-rating-icon ci-star-filled active"></i>
                                <i class="star-rating-icon ci-star-filled active"></i>
                                <i class="star-rating-icon ci-star-filled active"></i>
                                <i class="star-rating-icon ci-star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body card-body-hidden">
                        <a class="btn btn-primary btn-sm d-block w-100 mb-2"
                            href="{{ route('frontend.giohang.them', ['tensanpham_slug' => $sp->tensanpham_slug]) }}">
                            <i class="ci-cart fs-sm me-1"></i>Thêm vào giỏ hàng
                        </a>
                    </div>
                </div>
                <hr class="d-sm-none">
            </div>
            @endforeach
        </div>
    </section>
    @endforeach
@endsection