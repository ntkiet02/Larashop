@extends('layouts.frontend')
@section('title', 'Đơn hàng cá nhân')
@section('content')
<div class="page-title-overlap bg-dark pt-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                    <li class="breadcrumb-item">
                        <a class="text-nowrap" href="{{ route('frontend.home') }}"><i class="ci-home"></i>Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item text-nowrap">
                        <a href="{{ route('user.home') }}">Khách hàng</a>
                    </li>
                    <li class="breadcrumb-item text-nowrap active" aria-current="page">Hồ sơ</li>
                </ol>
            </nav>
        </div>
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 text-light mb-0">Hồ sơ khách hàng</h1>
        </div>
    </div>
</div>

<div class="container pb-5 mb-2 mb-md-4">
    <div class="row">
        <aside class="col-lg-4 pt-4 pt-lg-0 pe-xl-5">
            <div class="bg-white rounded-3 shadow-lg pt-1 mb-5 mb-lg-0">
                <div class="d-md-flex justify-content-between align-items-center text-center text-md-start p-4">
                    <div class="d-md-flex align-items-center">
                        <div class="img-thumbnail rounded-circle position-relative flex-shrink-0 mx-auto mb-2 mx-md-0 mb-md-0" style="width:6.375rem;">
                            <img class="rounded-circle" src="{{ asset('public/img/avatar.png') }}" />
                        </div>
                        <div class="ps-md-3">
                            <h3 class="fs-base mb-0">{{ $nguoidung->name }}</h3>
                            <span class="text-accent fs-sm">{{ $nguoidung->email }}</span>
                        </div>
                    </div>
                    <a class="btn btn-primary d-lg-none mb-2 mt-3 mt-md-0" href="#account-menu" data-bs-toggle="collapse" aria-expanded="false">
                        <i class="ci-menu me-2"></i>Hồ sơ khách hàng
                    </a>
                </div>
                <div class="d-lg-block collapse" id="account-menu">
                    <div class="bg-secondary px-4 py-3">
                        <h3 class="fs-sm mb-0 text-muted">Quản lý</h3>
                    </div>
                    <ul class="list-unstyled mb-0">
                        @if($nguoidung->DonHang->count() > 0)
                        <li class="border-bottom mb-0">
                            <a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ route('user.donhang') }}">
                                <i class="ci-bag opacity-60 me-2"></i>Đơn hàng<span class="fs-sm text-muted ms-auto">{{ $nguoidung->DonHang->count() }}</span>
                            </a>
                        </li>
                        @else
                        <li class="border-bottom mb-0">
                            <a class="nav-link-style d-flex align-items-center px-4 py-3" href="#">
                                <i class="ci-bag opacity-60 me-2"></i>Đơn hàng<span class="fs-sm text-muted ms-auto">0</span>
                            </a>
                        </li>
                        @endif
                        <li class="mb-0">
                            <a class="nav-link-style d-flex align-items-center px-4 py-3" href="#">
                                <i class="ci-star opacity-60 me-2"></i>Thiết lập tài khoản<span class="fs-sm text-muted ms-auto">0</span>
                            </a>
                        </li>
                    </ul>
                    <li class="d-lg-none border-top mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="ci-sign-out opacity-60 me-2"></i>Đăng xuất
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                            @csrf
                        </form>
                    </li>
                    </ul>
                </div>
            </div>
        </aside>
        <section class="col-lg-8">
            <div style="margin-top:80px">
            <h5 style="text-align: center;" class="modal-title">Chi tiết đơn hàng</h5>
        <form action="{{ route('user.donhangchitiet.sua', ['id' => $donhang->id]) }}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="dienthoai">Điện thoại giao hàng</label>
                <input type="text" class="form-control @error('dienthoai') is-invalid @enderror" id="dienthoai"
                    name="dienthoai" value="{{ $donhang->dienthoaigiaohang }}" required />
                @error('dienthoai')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="diachi">Địa chỉ giao hàng</label>
                <input type="text" class="form-control @error('diachi') is-invalid @enderror" id="diachi" name="diachi"
                    value="{{ $donhang->diachigiaohang }}" required />
                @error('diachi')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="table-responsive fs-md mb-4">
                <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Sản phẩm</th>
                        <th width="5%">SL</th>
                        <th width="15%">Đơn giá</th>
                        <th width="20%">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $tongtien = 0; 
                    @endphp
                    @foreach($donhang->DonHang_ChiTiet as $chitiet)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $chitiet->SanPham->tensanpham }}</td>
                        <td>{{ $chitiet->soluongban }}</td>
                        <td class="text-end">
                            {{ number_format($chitiet->dongiaban) }}<sup><u>đ</u></sup>
                        </td>
                        <td class="text-end">
                            {{ number_format($chitiet->soluongban * $chitiet->dongiaban) }}<sup><u>đ</u></sup>
                        </td>
                    </tr>
                    @php 
                    $tongtien += $chitiet->soluongban * $chitiet->dongiaban; 
                    @endphp
                    @endforeach
                    <tr>
                        <td colspan="4">Tổng tiền sản phẩm:</td>
                        <td class="text-end">
                            <strong>{{ number_format($tongtien) }}</strong><sup><u>đ</u></sup>
                        </td>
                    </tr>
                </tbody>
                </table>

            </div>
            <div class="mb-3">
                <label class="form-label" for="diachi">Tình trạng đơn hàng</label>
                <input type="text" class="form-control @error('diachi') is-invalid @enderror" id="diachi" name="diachi"
                    value="{{ $donhang->TinhTrang->tinhtrang }}" required />
                @error('diachi')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
        </form>
		</div>
        </section>
    </div>
</div>
@endsection