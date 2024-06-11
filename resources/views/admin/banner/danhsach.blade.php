@extends('layouts.app')
@section('content')
<section class="section">
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
               <h5 class="card-title">Danh sách banner</h5>
               <p>
                  <a href="{{ route('admin.banner.them') }}" class="btn btn-info"><i class="bi bi-plus"></i> Thêm
                     mới</a>
                  
               </p>
               <!-- Table with stripped rows -->
               <table class="table datatable">
                  <thead>
                     <tr>
                        <th width="5%">#</th>
                        <th width="15%">Hình ảnh</th>
                        <th width="45%">Tên hãng</th>
                        <th width="45%">Link</th>
                        <th width="30%">Kích hoạt</th>
                        <th width="5%">Sửa</th>
                        <th width="5%">Xóa</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($banner as $value)
                        <tr>
                           <td>{{ $loop->index + $banner->firstItem() }}</td>
                           <td class="text-center"><img src="{{ env('APP_URL') . '/storage/app/' . $value->hinhanh}}"
                              width="100" class="img-thumbnail" /> </td>
                           <td>{{ $value->tieude }}</td>
                           <td>{{ $value->link }}</td>
                           <td class="text-center" title="Trạng thái hiển thị">
                              <a href="{{ route('admin.banner.kichhoat', ['id' => $value->id]) }}">
                                 @if($value->kichhoat == 1)
                                 <i class="fa-light fa-lg fa-eye"> Đang Hiện </i>
                                 @else
                                 <i class="fa-light fa-lg fa-eye-slash text-danger"> Đã Ẩn</i>
                                 @endif
                              </a>
                           </td>
                           <td class="text-center"><a href="{{ route('admin.banner.sua', ['id' => $value->id]) }}"><i
                                 class="bi bi-pencil-square"></i></a></td>
                           <td class="text-center"><a href="{{ route('admin.banner.xoa', ['id' => $value->id]) }}"
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