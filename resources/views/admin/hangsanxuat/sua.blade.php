@extends('layouts.app')
@section('content')
 <div class="card">
 <div class="card-header">Sửa loại hãng sản xuất</div>
 <div class="card-body">
 <form action="{{ route('admin.hangsanxuat.sua', ['id' => $hangsanxuat->id]) }}" method="post" enctype="multipart/form-data">
 @csrf
 
 <div class="mb-3">
            <label class="form-label" for="tenhang">Tên hãng sản xuất</label>
            <input type="text" class="form-control @error('tenhang') is-invalid @enderror"  id="tenhang" name="tenhang" value="{{ $hangsanxuat->tenhang }}" required/>
                @error('tenhang')
                    <div class="invalid-feedback"> <strong >{{$message}}</strong> </div>
                @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="hinhanh">Hình ảnh</label>
            @if(empty($hangsanxuat->hinhanh))
                <image class="d-block rounded img-thumbnail" src="{{env('APP_URL') . '/storage/app/'.$value->hinhanh}}" width="100" ></image>
                <span class="d-block small text-danger">Bỏ trống nếu muốn giữ ảnh cũ.</span>
            @endif
            <input type="file" class="form-control @error('hinhanh') is-invalid @enderror"  id="hinhanh" name="hinhanh" />
                @error('hinhanh')
                    <div class="invalid-feedback"> <strong >{{$message}}</strong> </div>
                @enderror
        </div>
 
 
 <button type="submit" class="btn btn-primary" ><i class="bi bi-save"></i> Cập nhật</button>
 </form>
 </div>
 </div>
@endsection