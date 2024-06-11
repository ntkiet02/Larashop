<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banners;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class BannersController extends Controller
{
    public function getDanhSach()
	{
		$banner = Banners::paginate(50);
		return view('admin.banner.danhsach', compact('banner'));
	}

	public function getThem()
	{
		return view('admin.banner.them');
	}

	public function postThem(Request $request)
	{	
		$request->validate(['tieude' => ['required', 'max:200', 'unique:banner'],
		'hinhanh'=>['nullable','image','max:1024']
		]);
		
		//Load hình ảnh
		$path='';
		if($request->hasFile('hinhanh'))
		{
			$extention=$request->file('hinhanh')->extension();
			$filename=Str::slug($request->tieude, '-').'.'.$extention;
			$path=Storage::putFileAs('banner', $request->file ('hinhanh'), $filename);

		}
		//Them hang san xuat
		$orm = new Banners();
		$orm->tieude = $request->tieude;
        $orm->link = $request->link;
        $orm->kichhoat = 1;
		if(!empty($path)) $orm->hinhanh=$path;
		
		$orm->save();

		return redirect()->route('admin.banner');
	}

	public function getSua($id)
	{
		$banner = Banners::find($id);
		return view('admin.banner.sua', compact('banner'));
	}

	public function postSua(Request $request, $id)
	{	
		$request->validate(['tieude' => ['required', 'max:200', 'unique:banner,tieude,'. $id],
		'hinhanh'=>['nullable','image','max:1024']]);
		//Upload hinh anh
		$path='';
		if($request->hasFile('hinhanh'))
		{

			//Xoa file hinh cu
			$orm=Banners::find($id);
			if(!empty($orm->hinhanh)) Storage::delete($orm->hinhanh);
			//Upload file moi

			$extension= $request->file('hinhanh')->extension();
			$filename= Str::slug($request->tieude,'-') . '.' . $extension;
			$path= Storage::putFileAs('banner', $request->file('hinhanh'),$filename);
		}
		$orm = Banners::find($id);
		$orm->tieude = $request->tieude;
        $orm->link = $request->link;
        $orm->kichhoat = 1;
		if(!empty($path)) $orm->hinhanh=$path;
		
		$orm->save();

		return redirect()->route('admin.banner');
	}

	public function getXoa($id)
	{
		$orm = Banners::find($id);
		$orm->delete();
		if(!empty($orm->hinhanh))Storage::delete($orm->hinhanh);
		return redirect()->route('admin.banner');

	}
    public function getKichHoat(Request $request, $id)
    {
        $orm = Banners::find($id);
        $orm->kichhoat = 1 - $orm->kichhoat;
        $orm->save();
        return redirect()->route('admin.banner');
    }
}
