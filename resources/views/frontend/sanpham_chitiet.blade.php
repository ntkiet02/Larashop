@extends('layouts.frontend')

@section('title', 'Sản phẩm chi tiết')

@section('content')
		<!-- Page Title-->
		<div class="page-title-overlap bg-dark pt-4">
			<div class="container d-lg-flex justify-content-between py-2 py-lg-3">
				<div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
							<li class="breadcrumb-item">
								<a class="text-nowrap" href="{{ route('frontend.home') }}"><i class="ci-home"></i>Trang chủ</a>
							</li>
							<li class="breadcrumb-item text-nowrap">
								<a href="#">Sản phẩm</a>
							</li>
							<li class="breadcrumb-item text-nowrap active" aria-current="page">Chi tiết</li>
						</ol>
					</nav>
				</div>
				
				<div class="order-lg-1 pe-lg-4 text-center text-lg-start">
					<h1 class="h3 text-light mb-0">{{ $sanpham->tensanpham }}</h1>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="bg-light shadow-lg rounded-3 px-4 py-3 mb-5">
				<div class="px-lg-3">
					<div class="row">
						<div class="col-lg-7 pe-lg-0 pt-lg-4">
							<div class="product-gallery">
								<div class="product-gallery-preview order-sm-2">
									<div class="product-gallery-preview-item active" id="first">
										<img class="image-zoom" src="{{ env('APP_URL') . '/storage/app/' . $sanpham->hinhanh }}" data-zoom="{{ env('APP_URL') . '/storage/app/' . $sanpham->hinhanh }}" width="300" />
										<div class="image-zoom-pane"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-5 pt-4 pt-lg-0">
							<div class="product-details ms-auto pb-3">
								<div class="d-flex justify-content-between align-items-center mb-2">
									<a href="#reviews" data-scroll>
										<div class="star-rating">
											<i class="star-rating-icon ci-star-filled active"></i>
											<i class="star-rating-icon ci-star-filled active"></i>
											<i class="star-rating-icon ci-star-filled active"></i>
											<i class="star-rating-icon ci-star-filled active"></i>
											<i class="star-rating-icon ci-star"></i>
										</div>
										<span class="d-inline-block fs-sm text-body align-middle mt-1 ms-1">74 đánh giá</span>
									</a>
								</div>
								<div class="mb-3">
									<span class="h3 fw-normal text-accent me-1">{{ number_format($sanpham->dongia, 0, ',', '.') }}<small>đ</small></span>
								</div>
								<form class="mb-grid-gutter" action="{{ route('frontend.giohang.them', ['tensanpham_slug' => $sanpham->tensanpham_slug]) }}" method="get">
									@csrf
									<div class="mb-3 d-flex align-items-center">
										<select class="form-select me-3" style="width:5rem;">
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
										<button class="btn btn-primary btn-shadow d-block w-100" type="submit"><i class="ci-cart fs-lg me-2"></i>Thêm vào giỏ hàng</button>
									</div>
								</form>
								<div class="accordion mb-4" id="productPanels">
									<div class="accordion-item">
										<h3 class="accordion-header">
											<a class="accordion-button" href="#productInfo" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="productInfo">
												<i class="ci-announcement text-muted fs-lg align-middle mt-n1 me-2"></i>Thông tin cơ bản
											</a>
										</h3>
										<div class="accordion-collapse collapse show" id="productInfo" data-bs-parent="#productPanels">
											<div class="accordion-body">
												<p></p>
											</div>
										</div>
									</div>
									<div class="accordion-item">
										<h3 class="accordion-header">
											<a class="accordion-button collapsed" href="#shippingOptions" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="shippingOptions">
												<i class="ci-settings text-muted lead align-middle mt-n1 me-2"></i>Thông số kỹ thuật
											</a>
										</h3>
										<div class="accordion-collapse collapse" id="shippingOptions" data-bs-parent="#productPanels">
											<div class="accordion-body">
												<p></p>
											</div>
										</div>
									</div>
									<div class="accordion-item">
										<h3 class="accordion-header">
											<a class="accordion-button collapsed" href="#localStore" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="localStore">
												<i class="ci-package text-muted fs-lg align-middle mt-n1 me-2"></i>Hình thức đóng gói
											</a>
										</h3>
										<div class="accordion-collapse collapse" id="localStore" data-bs-parent="#productPanels">
											<div class="accordion-body">
												<p></p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		
		</div>
@endsection