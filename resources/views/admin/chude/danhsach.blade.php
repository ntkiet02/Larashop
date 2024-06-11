@extends('layouts.app')
@section('content')
<div class="card">
   <div class="card-header">Chủ đề</div>
   <div class="card-body table-responsive">
      <p>
         <a href="{{ route('admin.chude.them') }}" class="btn btn-info"><i class="bi bi-plus"></i> Thêm mới</a>
      </p>
      <table class="table table-bordered table-hover table-sm mb-0">
         <thead>
            <tr>
               <th width="5%">#</th>
               <th width="45%">Tên chủ đề</th>
               <th width="30%">Tên chủ đề không dấu</th>
               <th width="5%">Sửa</th>
               <th width="5%">Xóa</th>
            </tr>
         </thead>
         <tbody>
            @foreach($chude as $value)
            <tr>
               <td>{{ $loop->iteration }}</td>
               <td>{{ $value->tenchude }}</td>
               <td>{{ $value->tenchude_slug }}</td>
               <td class="text-center"><a href="{{ route('admin.chude.sua', ['id' => $value->id]) }}"><i
                        class="bi bi-pencil-square"></i></a></td>
               <td class="text-center"><a href="{{ route('admin.chude.xoa', ['id' => $value->id]) }}"
                     onclick="alert(confirm('Bạn chắc chắn muốn xóa '))"><i class="bi bi-trash text-danger"></i></a>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>


   </div>
</div>

@endsection