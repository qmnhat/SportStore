<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BaiViet;
use App\Models\User;
use Illuminate\Support\Str;
class AdminBaiVietController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = BaiViet::with(['author']);
        // Tìm kiếm
        if ($request->filled('q')) {
            $query->where('TieuDe','like','%'.$request->q.'%');
        }
        //sắp xếp
        if($request->sort==='asc'){
            $query->orderBy('NgayTao','asc');
        }else{
            $query->orderBy('NgayTao','desc');
        }

        $baiviets=(clone $query)
            ->where('IsDeleted',false)
            ->paginate(10,['*'],'active_page');
        $deletedBaiviets=(clone $query)
            ->where('IsDeleted',true)
            ->paginate(10,['*'],'deleted_page');

        return view('admin.baiviet.index', compact('baiviets', 'deletedBaiviets'));
    }
    public function create(){
        return view('admin.baiviet.create');
    }
    public function store(Request $request){
        $request->validate([
            'TieuDe' => 'required|max:200',
            'NoiDung' => 'required',
            'TomTat' => 'nullable|max:500',
            'HinhAnh' => 'nullable|image|max:2048',
            'TrangThai' => 'required|in:0,1',
        ]);

        $data = [
            'TieuDe'=>$request->TieuDe,
            'slug'=>Str::slug($request->TieuDe).'-'.time(),
            'NoiDung'=>$request->NoiDung,
            'TomTat'=>$request->TomTat,
            'NguoiTao'=>auth()->user()->id,
            'NgayTao'=>now(),
            'TrangThai'=>$request->TrangThai,
            'IsDeleted'=>false,
        ];

        if ($request->hasFile('HinhAnh')) {
            $file = $request->file('HinhAnh');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/blog'), $filename);
            $data['HinhAnh'] = 'uploads/blog/' . $filename;
        }

        BaiViet::create($data);

        return redirect()->route('admin.baiviet.index')->with('success','Thêm bài viết thành công');
    }
    public function edit($id){
        $baiViet=BaiViet::findOrFail($id);
        return view('admin.baiviet.edit',compact('baiViet'));
    }
    public function update(Request $request,$id){
        $baiViet=BaiViet::findOrFail($id);
        $data = [
            'TieuDe'=>$request->TieuDe,
            'NoiDung'=>$request->NoiDung,
            'TomTat'=>$request->TomTat,
            'NgayCapNhat'=>now(),
            'TrangThai'=>$request->TrangThai,
        ];

        if ($request->hasFile('HinhAnh')) {
            // Xóa hình cũ nếu tồn tại
            if ($baiViet->HinhAnh && file_exists(public_path($baiViet->HinhAnh))) {
                unlink(public_path($baiViet->HinhAnh));
            }
            $file = $request->file('HinhAnh');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/blog'), $filename);
            $data['HinhAnh'] = 'uploads/blog/' . $filename;
        }

        $baiViet->update($data);

        return redirect()->route('admin.baiviet.index')->with('success','Cập nhật bài viết thành công');
    }
    public function destroy($id){
        $baiViet=BaiViet::findOrFail($id);
        $baiViet->update([
            'IsDeleted'=>true,
            'DeletedAt'=>now(),
        ]);
        return redirect()->route('admin.baiviet.index')->with('success','Xóa bài viết thành công');
    }
    public function restore($id){
        $baiViet=BaiViet::findOrFail($id);
        $baiViet->update([
            'IsDeleted'=>false,
            'DeletedAt'=>null,
        ]);
        return redirect()->route('admin.baiviet.index')->with('success','Khôi phục bài viết thành công');
    }
}
