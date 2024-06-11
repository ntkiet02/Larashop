<?php

namespace App\Http\Controllers;

use App\Mail\DatHangEmail;
use Illuminate\Http\Request;
use App\Models\DonHang;
use App\Models\DonHang_ChiTiet;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Exception;
use App\Models\SanPham;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\NguoiDung;
use App\Models\TinhTrang;
use Illuminate\Support\Facades\Str;
class KhachHangController extends Controller
{
    public function getHome()
    {
        return view('user.home');
    }

    public function getDatHang()
    {
        if(Auth::check())
            return view('user.dathang');
        else
            return redirect()->route('user.dangnhap');
    }

    public function postDatHang(Request $request)
    {$this->validate($request, [
        'diachigiaohang' => ['required', 'string', 'max:255'],
        'dienthoaigiaohang' => ['required', 'string', 'max:255'],
    ]);
    
    // Bắt đầu giao dịch
    DB::beginTransaction();
    
    try {
        // Lưu vào đơn hàng
        $dh = new DonHang();
        $dh->nguoidung_id = Auth::user()->id;
        $dh->tinhtrang_id = 1; // Đơn hàng mới
        $dh->diachigiaohang = $request->diachigiaohang;
        $dh->dienthoaigiaohang = $request->dienthoaigiaohang;
        $dh->save();
    
        // Lưu vào đơn hàng chi tiết và cập nhật tồn kho
        foreach (Cart::content() as $value) {
            $sanpham = SanPham::find($value->id); // Giả sử bạn có model SanPham cho sản phẩm
    
            if ($sanpham->soluong >= $value->qty) {
                 // Kiểm tra nếu còn đủ hàng tồn kho
                $sanpham->soluong -= $value->qty; // Giảm số lượng tồn kho
                $sanpham->save(); // Lưu lại sản phẩm với số lượng tồn kho mới
    
                $ct = new DonHang_ChiTiet();
                $ct->donhang_id = $dh->id;
                $ct->sanpham_id = $value->id;
                $ct->soluongban = $value->qty;
                $ct->dongiaban = $value->price;
                $ct->save();
            } else {
                // Nếu không đủ tồn kho, hủy bỏ giao dịch và thông báo lỗi
                DB::rollBack();
                return redirect()->route('user.dathang')->with('error', 'Sản phẩm ' . $sanpham->ten . ' không đủ hàng tồn kho.');
            }
        }
         DB::commit();
        try{
            Mail::to(Auth::user()->email)->send(new DatHangEmail($dh));
        }
        catch(Exception $e){
            return $e->getMessage();
        }
        return redirect()->route('user.dathangthanhcong');
       
    
        // Chuyển hướng đến trang đặt hàng thành công
        } catch (Exception $e) {
            
            DB::rollBack();
            return redirect()->route('user.cart')->with('error', 'Đã có lỗi xảy ra: ' . $e->getMessage());
        }
      
    }

    public function getDatHangThanhCong()
    {
        Cart::destroy();
 
        return view('user.dathangthanhcong');
    }

    public function getDonHang($id = '')
    {
        $id = Auth::user()->id;
        $donhang = DonHang::where('nguoidung_id', $id)->get();
        $donhangchitiet=DonHang_ChiTiet::with('sanpham')->where('donhang_id',$id);
        $nguoidung = NguoiDung::find($id);
        return view('user.donhang',compact('nguoidung','donhang','donhangchitiet'));
    }
    public function getSuaDonHangChiTiet($orderId)
    {
        $userId = Auth::user()->id;
        $donhang = DonHang::where('nguoidung_id', $userId)->where('id', $orderId)->first();
        if (!$donhang) {
            return redirect()->back()->with('error', 'Order not found.');
        }
        $tinhtrang = TinhTrang::all();
        $nguoidung = NguoiDung::find($userId);
        return view('user.donhangchitiet', compact('donhang', 'tinhtrang', 'nguoidung'));
    }
    

    public function postSuaDonHangChiTiet(Request $request, $id)
    {
        $request->validate([
            'dienthoai' => ['required', 'max:20'],
            'diachi' => ['required', 'max:255'],
            'tinhtrang' => ['required'],
            ]);
            
            $orm = DonHang::find($id);
            $orm->dienthoaigiaohang = $request->dienthoai;
            $orm->diachigiaohang = $request->diachi;
            $orm->tinhtrang = $request->tinhtrang;
            $orm->save();
            
            return redirect()->route('user.donhangchitiet');
    }
    public function postHuyDonHang(Request $request, $id)
    {
        $orm = DonHang::find($id);
        $orm->tinhtrang_id = 5;
        $orm->save();      
        return redirect()->route('user.donhang');
    }
    public function postDonHang(Request $request, $id)
    {
        $request->validate([
            'dienthoai' => ['required', 'max:20'],
            'diachi' => ['required', 'max:255'],
            'tinhtrang' => ['required'],
            ]);
            
        $orm = DonHang::find($id);
        $orm->dienthoaigiaohang = $request->dienthoai;
        $orm->diachigiaohang = $request->diachi;
        $orm->tinhtrang = $request->tinhtrang;
        $orm->save();
        
        return redirect()->route('user.donhang');
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
        return redirect()->route('user.donhang');
    }

    public function getHoSoCaNhan()
    {
         $id = Auth::user()->id;
        $nguoidung = NguoiDung::find($id);
        return view('user.hosocanhan',compact('nguoidung'));
    }

    public function postHoSoCaNhan(Request $request)
    {
        $id = Auth::user()->id;
 
        $request->validate([
        'name' => ['required', 'string', 'max:100'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
        'password' => ['confirmed'],
        ]);
        
        $orm = NguoiDung::find($id);
        $orm->name = $request->name;
        $orm->username = Str::before($request->email, '@');
        $orm->email = $request->email;
        if(!empty($request->password)) $orm->password = Hash::make($request->password);
        $orm->save();
        
        return redirect()->route('user.home')->with('success', 'Đã cập nhật thông tin thành công.');
    }

    public function postDangXuat(Request $request)
    {
        // Bổ sung code tại đây
        return redirect()->route('frontend.home');
    }
}
