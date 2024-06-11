<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\DonHang_ChiTiet;
use App\Models\TinhTrang;
use Illuminate\Http\Request;


class DonHangController extends Controller
{
    //     public function __construct()
//  {
//  $this->middleware('auth');
//  }

    public function getDanhSach()
    {
        $donhang = DonHang::orderBy('created_at', 'desc')->get();
        return view('admin.donhang.danhsach', compact('donhang'));
    }

    public function getThem()
    {
        // Đặt hàng bên Front-end
    }

    public function postThem(Request $request)
    {
        // Xử lý đặt hàng bên Front-end
    }

    public function getSua($id)
    {
        $donhang = DonHang::find($id);
        $tinhtrang = TinhTrang::all();
        return view('admin.donhang.sua', compact('donhang', 'tinhtrang'));
    }

    public function postSua(Request $request, $id)
    {
        $request->validate([
            'dienthoai' => ['required', 'max:20'],
            'diachi' => ['required', 'max:255'],
            'tinhtrang_id' => ['required'],
        ]);
    
        $orm = DonHang::find($id);
        $orm->dienthoaigiaohang = $request->dienthoai;
        $orm->diachigiaohang = $request->diachi;
        $orm->tinhtrang_id = $request->tinhtrang_id;
        $orm->save();
    
        return redirect()->route('admin.donhang');
    }
    

    public function getXoa($id)
    {
        // Tìm đơn hàng
        $orm = DonHang::find($id);
    
        // Xóa các chi tiết đơn hàng liên quan
        foreach ($orm->DonHang_ChiTiet as $chitiet) {
            $chitiet->delete();
        }
    
        // Xóa đơn hàng
        $orm->delete();
    
        // Điều hướng trở lại danh sách đơn hàng
        return redirect()->route('admin.donhang');
    }
    
}
