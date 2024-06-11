@extends('layouts.frontend')
@section('title', 'Sản phẩm tìm kiếm')

@section('content')
<<div class="container">
    <h2>Kết quả tìm kiếm cho "{{ $q }}"</h2>

    @if($danhsach->count() > 0)
        <div class="row">
            @foreach($danhsach as $dsSP)

        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
            <div class="card product-card">
                <a class="card-img-top d-block overflow-hidden"
                    href="">
                    <img src="{{ env('APP_URL') . '/storage/app/' . $dsSP->hinhanh }}" />
                </a>
                <div class="card-body py-2">
                    <a class="product-meta d-block fs-xs pb-1" href="#"></a>
                    <h3 class="product-title fs-sm">
                        <a
                            href="">{{
                            $dsSP->tensanpham }}</a>
                    </h3>
                    <div class="d-flex justify-content-between">
                        <div class="product-price">
                            <span class="text-accent">{{ number_format($dsSP->dongia, 0, ',', '.')
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
                        href="{{ route('frontend.giohang.them', ['tensanpham_slug' => $dsSP->tensanpham_slug]) }}">
                        <i class="ci-cart fs-sm me-1"></i>Thêm vào giỏ hàng
                    </a>
                </div>
            </div>

            <hr class="d-sm-none">
        </div>
        @endforeach

        </div>

        <div class="d-flex justify-content-center">
            {{ $danhsach->links() }}
        </div>
    @else
        <p>Không tìm thấy sản phẩm nào khớp với từ khóa "{{ $q }}".</p>
    @endif
</div>
@endsection