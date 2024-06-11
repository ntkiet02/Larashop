<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ route('admin.home') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Quản lý sản phẩm</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.loaisanpham') }}">
              <i class="bi bi-circle"></i><span>Loại sản phẩm</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.hangsanxuat') }}">
              <i class="bi bi-circle"></i><span>Hãng sản xuất</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.sanpham') }}">
              <i class="bi bi-circle"></i><span>Sản phẩm</span>
            </a>
          </li>
        </ul> 
      </li><!-- End Components Nav --> 
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Quản lý đơn hàng</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.tinhtrang') }}">
              <i class="bi bi-circle"></i><span>Tình trạng</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin.donhang')}}">
              <i class="bi bi-circle"></i><span>Đơn hàng</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->  
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('admin.nguoidung')}}">
          <i class="bi bi-dash-circle"></i>
          <span>Người dùng</span>
        </a>
      </li><!-- End Error 404 Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('admin.banner')}}">
          <i class="bi bi-file-earmark"></i>
          <span>Banners</span>
        </a>
      </li><!-- End Blank Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->