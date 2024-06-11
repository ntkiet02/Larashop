@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">Chỉnh sửa đơn hàng</div>
    <div class="card-body">
        <form action="{{ route('admin.donhang.sua', ['id' => $donhang->id]) }}" method="post">
    @csrf
    @method('POST') <!-- Thêm dòng này -->

    <div class="mb-3">
        <label class="form-label" for="user_id">Khách hàng</label>
        <input type="text" class="form-control" id="nguoidung" name="nguoidung_id" value="{{ $donhang->NguoiDung->name }}" disabled required />
    </div>

    <div class="mb-3">
        <label class="form-label" for="dienthoai">Điện thoại giao hàng</label>
        <input type="text" class="form-control @error('dienthoai') is-invalid @enderror" id="dienthoai" name="dienthoai" value="{{ $donhang->dienthoaigiaohang }}" required />
        @error('dienthoai')
        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label" for="diachi">Địa chỉ giao hàng</label>
        <input type="text" class="form-control @error('diachi') is-invalid @enderror" id="diachi" name="diachi" value="{{ $donhang->diachigiaohang }}" required />
        @error('diachi')
        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label" for="tinhtrang_id">Tình trạng đơn hàng</label>
        <select class="form-select @error('tinhtrang_id') is-invalid @enderror" id="tinhtrang_id" name="tinhtrang_id" required>
            <option value="">-- Chọn tình trạng --</option>
            @foreach($tinhtrang as $value)
            <option value="{{ $value->id }}" {{ ($donhang->tinhtrang_id == $value->id) ? 'selected' : '' }}>{{ $value->tinhtrang }}</option>
            @endforeach
        </select>
        @error('tinhtrang_id')
        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Cập nhật</button>
</form>

    </div>
</div>
@endsection