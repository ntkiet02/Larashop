<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonHang;
use App\Models\NguoiDung;

class AdminController extends Controller
{
    public function getHome()
    {
        $totalUsers = NguoiDung::where('role', 'user')->count();
        $totalOrders = DonHang::where('tinhtrang_id', 3)->count();
        return view('admin.home', compact('totalUsers', 'totalOrders'));
    }
}
