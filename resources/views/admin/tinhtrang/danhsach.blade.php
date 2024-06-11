@extends('layouts.app')
@section('content')
 <div class="card">
 <div class="card-header">Tình Trạng</div>
 <div class="card-body table-responsive">
 <p><a href="{{ route('admin.tinhtrang.them') }}" class="btn btn-info"><i class="bi bi-plus"></i> Thêm mới</a></p>
 <table class="table table-bordered table-hover table-sm mb-0">
 <thead>
 <tr>
 <th width="5%">#</th>
 <th width="45%">Tình trạng</th>
 <th width="40%">Tình trạng không dấu</th>
 <th width="5%">Sửa</th>
 <th width="5%">Xóa</th>
 </tr>
 </thead>
 <tbody>
 @foreach($tinhtrang as $value)
 <tr>
 <td>{{ $loop->iteration }}</td>
 <td>{{ $value->tinhtrang }}</td>
 <td>{{ $value->tinhtrang_slug }}</td>
 <td class="text-center"><a href="{{ route('admin.tinhtrang.sua', ['id' => $value->id]) }}"><i class="bi bi-pencil-square"></i></a></td>
 <td class="text-center"><a href="{{ route('admin.tinhtrang.xoa', ['id' => $value->id]) }}" onclick="alert(confirm('Bạn chắc chắn muốn xóa '))"><i class="bi bi-trash text-danger"></i></a></td>
 </tr>
 @endforeach
 </tbody>
 </table>
 </div>
 </div>
@endsection