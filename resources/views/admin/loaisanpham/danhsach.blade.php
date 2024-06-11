@extends('layouts.app')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Danh sách loại sản phẩm</h5>
                    <p>
                        <a href="{{ route('admin.loaisanpham.them') }}" class="btn btn-info"><i class="bi bi-plus"></i> Thêm mới</a>
                    </p>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th >#</th>
                                <th >Tên loại</th>
                                <th >Tên loại không dấu</th>
                                <th >Sửa</th>
                                <th >Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loaisanpham as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->tenloai }}</td>
                                    <td>{{ $value->tenloai_slug }}</td>
                                    <td class="text-center"><a
                                            href="{{ route('admin.loaisanpham.sua', ['id' => $value->id]) }}"><i
                                                class="bi bi-pencil-square"></i></a></td>
                                    <td class="text-center"><a
                                            href="{{ route('admin.loaisanpham.xoa', ['id' => $value->id]) }}"
                                            onclick="alert(confirm('Bạn chắc chắn muốn xóa '))"><i
                                                class="bi bi-trash text-danger"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>

        </div>
    </div>
</section>
@endsection