@extends('layouts.app')
@section('content')

 <div class="card">
   <div class="card-body">
      <h5 class="card-title">Thêm loại sản phẩm<</h5>
      <!-- Vertical Form -->
      <form class="row g-3" action="{{ route('admin.loaisanpham.them') }}" method="post">
      @csrf
         <div class="col-12">
            <label for="tenloai" class="form-label">Tên loại</label>
            <input type="text" class="form-control"id="tenloai" name="tenloai">
         </div>
            <button type="submit" class="btn btn-primary">Submit</button>
         </div>
      </form><!-- Vertical Form -->
   </div>
</div>
@endsection