<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NhaCungCapController extends Controller
{
    // LIST
    public function index(Request $request)
    {
        $query = DB::table('NhaCungCap');

        // SEARCH
        if ($request->q) {
            $query->where(function ($q) use ($request) {
                $q->where('TenNCC', 'like', '%' . $request->q . '%')
                    ->orWhere('Email', 'like', '%' . $request->q . '%');
            });
        }

        // FILTER STATUS
        if ($request->status !== null && $request->status !== '') {
            $query->where('TrangThai', $request->status);
        }

        // SORT
        if ($request->sort == 'asc') {
            $query->orderBy('MaNCC', 'asc');
        } else {
            $query->orderBy('MaNCC', 'desc');
        }

        // ACTIVE
        $activeNCC = (clone $query)
            ->where('IsDeleted', false)
            ->paginate(10);

        // DELETED
        $deletedNCC = (clone $query)
            ->where('IsDeleted', true)
            ->paginate(10);

        return view('admin.NhaCungCap.index', compact(
            'activeNCC',
            'deletedNCC'
        ));
    }


    // FORM CREATE
    public function create()
    {
        return view('admin.NhaCungCap.create');
    }

    // SAVE CREATE
    public function store(Request $request)
    {
        DB::table('NhaCungCap')->insert([
            'TenNCC' => $request->TenNCC,
            'DiaChi' => $request->DiaChi,
            'SDT' => $request->SDT,
            'Email' => $request->Email,
            'TrangThai' => $request->TrangThai,
        ]);

        return redirect('/admin/nha-cung-cap');
    }

    // FORM EDIT
    public function edit($id)
    {
        $ncc = DB::table('NhaCungCap')
            ->where('MaNCC', $id)
            ->first();

        return view('admin.NhaCungCap.edit', compact('ncc'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        DB::table('NhaCungCap')
            ->where('MaNCC', $id)
            ->update([
                'TenNCC' => $request->TenNCC,
                'DiaChi' => $request->DiaChi,
                'SDT' => $request->SDT,
                'Email' => $request->Email,
                'TrangThai' => $request->TrangThai,
            ]);

        return redirect('/admin/nha-cung-cap');
    }
    public function delete($id)
    {
        DB::table('NhaCungCap')
            ->where('MaNCC', $id)
            ->update([
                'IsDeleted' => true,
                'DeletedAt' => now()
            ]);

        return redirect('/admin/nha-cung-cap');
    }
}
