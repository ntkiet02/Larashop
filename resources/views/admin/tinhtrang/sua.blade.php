@extends('layouts.app')
@section('content')
 <div class="card">
 <div class="card-header">Sửa tình trạng sản phẩm</div>
 <div class="card-body">
 <form action="{{ route('admin.tinhtrang.sua', ['id' => $tinhtrang->id]) }}" method="post">
 @csrf
 
 <div class="mb-3">
 <label class="form-label" for="tinhtrang">Tên tình trạng</label>
 </div>
 <input type="text" class="form-control @error('tinhtrang') is-invalid @enderror"  id="tinhtrang" name="tinhtrang"value="{{ $loaisanpham->tinhtrang }} "/>
 @error('tinhtrang')
    <div class="invalid-feedback"> <strong >{{$message}}</strong> </div>
 @enderror

 <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Cập nhật</button>
</div>
 </form>
 </div>
 </div>
@endsection