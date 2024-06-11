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
            <div class="d-flex justify-content-between align-items-center pt-lg-2 pb-4 pb-lg-5 mb-lg-3">
                <div class="d-flex align-items-center">
                    <label class="d-none d-lg-block fs-sm text-light text-nowrap opacity-75 me-2" for="order-sort">Sắp xếp theo:</label>
                    <label class="d-lg-none fs-sm text-nowrap opacity-75 me-2" for="order-sort">Sắp xếp theo:</label>
             
                    <select class="form-select" id="order-sort">
                        <option>Tất cả</option>
                        <option>Đã giao</option>
                        <option>Đang vận chuyển</option>
                        <option>Đã chuyển hoàn</option>
                        <option>Đã hủy</option>
                    </select>
                </div>
                <a class="btn btn-primary btn-sm d-none d-lg-inline-block" href="#">
                    <i class="ci-sign-out me-2"></i>Đăng xuất
                </a>
            </div>
            <!--  ////////////// -->
            <div class="table-responsive fs-md mb-4">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Ngày đặt hàng</th>
                            <th>Trạng thái</th>
                            <th>Tùy chọn</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donhang as $value)
                        <tr>
                            <td class="py-3">{{ $loop->iteration }}</td>
                            <td class="py-3">{{ $value->created_at->format('d/m/Y H:i:s') }}</td>

                            @if ($value->tinhtrang_id==5)
                                <td class="py-3"><span class="badge bg-danger m-0">{{ $value->TinhTrang->tinhtrang }}</span></td>
                            @elseif($value->tinhtrang_id==4)
                                <td class="py-3"><span class="badge bg-success m-0">{{ $value->TinhTrang->tinhtrang }}</span></td>
                            @elseif($value->tinhtrang_id==3)
                            <td class="py-3"><span class="badge bg-warning m-0">{{ $value->TinhTrang->tinhtrang }}</span></td>
                            @else
                                <td class="py-3"><span class="badge bg-info m-0">{{ $value->TinhTrang->tinhtrang }}</span></td>
                            @endif

                            <td class="py-3"><a href="{{route('user.donhangchitiet', ['id' => $value->id])}}"><spana class="badge bg-info m-0">Xem chi tiết</spana></a></td>
                            @if ($value->tinhtrang_id==5)
                                <td class="py-3"><a href="{{route('user.xoadonhang', ['id' => $value->id])}}" ><span class="badge bg-danger m-0">Xóa</span></a></td>
                            @elseif ($value->tinhtrang_id==3)
                            <td class="py-3"><a href="#" ><span class="badge bg-info m-0">Đánh giá</span></a></td>
                            @else
                            <td class="py-3">
                                <form action="{{ route('user.huydonhang', ['id' => $value->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0" style="background: none; border: none;">
                                        <span class="badge bg-danger m-0">Hủy đơn</span>
                                    </button>
                                </form>
                            </td>
                            @endif
                        @endforeach
                    </tbody>
                </table>

            </div>
        </section>
    </div>
</div>
@endsection