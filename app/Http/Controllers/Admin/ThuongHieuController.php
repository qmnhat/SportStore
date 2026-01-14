<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThuongHieu;
use Illuminate\Http\Request;

class ThuongHieuController extends Controller
{
    public function index(Request $request)
    {
        $query = ThuongHieu::query();

        // Tìm kiếm
        if ($request->filled('q')) {
            $query->where('TenTH', 'like', '%' . $request->q . '%');
        }

        // Sắp xếp
        if ($request->sort === 'asc') {
            $query->orderBy('MaTH', 'asc');
        } else {
            $query->orderBy('MaTH', 'desc');
        }

        $activeTH = (clone $query)
            ->where('IsDeleted', false)
            ->paginate(10, ['*'], 'active_page');

        $deletedTH = (clone $query)
            ->where('IsDeleted', true)
            ->paginate(10, ['*'], 'deleted_page');

        return view('admin.thuonghieu.index', compact('activeTH', 'deletedTH'));
    }

    public function create()
    {
        return view('admin.thuonghieu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'TenTH' => 'required|max:100',
        ]);

        ThuongHieu::create([
            'TenTH' => $request->TenTH,
            'MoTa' => $request->MoTa,
        ]);

        return redirect()->route('admin.thuonghieu.index');
    }

    public function edit($id)
    {
        $thuonghieu = ThuongHieu::findOrFail($id);
        return view('admin.thuonghieu.edit', compact('thuonghieu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'TenTH' => 'required|max:100',
        ]);

        $thuonghieu = ThuongHieu::findOrFail($id);
        $thuonghieu->update($request->only('TenTH', 'MoTa'));

        return redirect()->route('admin.thuonghieu.index');
    }

    public function destroy($id)
    {
        ThuongHieu::where('MaTH', $id)->update([
            'IsDeleted' => true,
            'DeletedAt' => now(),
        ]);

        return redirect()->back();
    }

    public function restore($id)
    {
        ThuongHieu::where('MaTH', $id)->update([
            'IsDeleted' => false,
            'DeletedAt' => null,
        ]);

        return redirect()->back();
    }
}
