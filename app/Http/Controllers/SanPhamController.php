<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SanPhamController extends Controller
{
    public function index(Request $request)
    {
        $tuKhoa = (string) $request->get('q', '');
        $maDM = $request->get('dm');   // MaDM
        $maTH = $request->get('th');   // MaTH
        $gia = $request->get('gia');   // 1 | 2 | 3

        // ===== (SUA SO SAO) RATING SUBQUERY =====
        $ratingSub = DB::table('DanhGia as dg')
            ->select(
                'dg.MaSP',
                DB::raw('ROUND(AVG(dg.SoSao), 1) as saoTrungBinh'),
                DB::raw('COUNT(*) as soLuotDanhGia')
            )
            ->groupBy('dg.MaSP');

        // ===== DANH MUC + SO LUONG SAN PHAM =====
        $danhMucs = DB::table('DanhMuc as dm')
            ->leftJoin('SanPham as sp', function ($join) {
                $join->on('sp.MaDM', '=', 'dm.MaDM')
                    ->where('sp.IsDeleted', 0);
            })
            ->where('dm.IsDeleted', 0)
            ->groupBy('dm.MaDM', 'dm.TenDM')
            ->select('dm.MaDM', 'dm.TenDM', DB::raw('COUNT(sp.MaSP) as soLuong'))
            ->orderBy('dm.MaDM')
            ->get();

        // ===== THUONG HIEU + SO LUONG SAN PHAM =====
        $thuongHieus = DB::table('ThuongHieu as th')
            ->leftJoin('SanPham as sp', function ($join) {
                $join->on('sp.MaTH', '=', 'th.MaTH')
                    ->where('sp.IsDeleted', 0);
            })
            ->where('th.IsDeleted', 0)
            ->groupBy('th.MaTH', 'th.TenTH')
            ->select('th.MaTH', 'th.TenTH', DB::raw('COUNT(sp.MaSP) as soLuong'))
            ->orderBy('th.MaTH')
            ->get();

        // ===== SAN PHAM LIST =====
        $sanPhams = DB::table('SanPham as sp')
            ->leftJoin('DanhMuc as dm', 'dm.MaDM', '=', 'sp.MaDM')
            ->leftJoin('ThuongHieu as th', 'th.MaTH', '=', 'sp.MaTH')

            // ===== (SUA SO SAO) JOIN RATING =====
            ->leftJoinSub($ratingSub, 'rt', function ($join) {
                $join->on('rt.MaSP', '=', 'sp.MaSP');
            })

            ->leftJoin('BienTheSanPham as bt', function ($join) {
                $join->on('bt.MaSP', '=', 'sp.MaSP')
                    ->where('bt.IsDeleted', 0)
                    ->where('bt.TrangThai', 1);
            })
            ->leftJoin('HinhAnhSanPham as ha', 'ha.MaSP', '=', 'sp.MaSP')
            ->where('sp.IsDeleted', 0)
            // filter danh muc
            ->when($maDM, function ($q) use ($maDM) {
                $q->where('sp.MaDM', $maDM);
            })

            // filter thuong hieu
            ->when($maTH, function ($q) use ($maTH) {
                $q->where('sp.MaTH', $maTH);
            })

            // search ten va mo ta san pham
            ->when($tuKhoa !== '', function ($q) use ($tuKhoa) {
                $q->where('sp.TenSP', 'like', '%' . $tuKhoa . '%')
                    ->orWhere('sp.MoTa', 'like', '%' . $tuKhoa . '%');
            })

            ->groupBy(
                'sp.MaSP',
                'sp.TenSP',
                'sp.MoTa',
                'dm.TenDM',
                'th.TenTH',
                // ===== (SUA SO SAO) GROUP BY RATING =====
                'rt.saoTrungBinh',
                'rt.soLuotDanhGia'
            )
            ->select(
                'sp.MaSP',
                'sp.TenSP',
                'sp.MoTa',
                'dm.TenDM as tenDanhMuc',
                'th.TenTH as tenThuongHieu',
                DB::raw('MIN(bt.GiaGoc) as giaMin'),
                DB::raw('MIN(ha.DuongDan) as anhDauTien'),

                // ===== (SUA SO SAO) SELECT RATING =====
                DB::raw('COALESCE(rt.saoTrungBinh, 0) as saoTrungBinh'),
                DB::raw('COALESCE(rt.soLuotDanhGia, 0) as soLuotDanhGia')
            )

            // filter gia: dua theo MIN(bt.GiaGoc)
            ->when($gia, function ($q) use ($gia) {
                if ($gia == '1') {
                    $q->havingRaw('MIN(bt.GiaGoc) < 1000000');
                } elseif ($gia == '2') {
                    $q->havingRaw('MIN(bt.GiaGoc) < 2000000');
                } elseif ($gia == '3') {
                    $q->havingRaw('MIN(bt.GiaGoc) >= 2000000');
                }
            })

            ->orderBy('sp.MaSP', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('products.san-pham', compact(
            'sanPhams',
            'danhMucs',
            'thuongHieus',
            'tuKhoa',
            'maDM',
            'maTH',
            'gia'
        ));
    }


    public function show($maSP)
    {
        $ratingSub = DB::table('DanhGia as dg')
            ->select(
                'dg.MaSP',
                DB::raw('ROUND(AVG(dg.SoSao), 1) as saoTrungBinh'),
                DB::raw('COUNT(*) as soLuotDanhGia')
            )
            ->groupBy('dg.MaSP');

        // San pham
        $sanPham = DB::table('SanPham as sp')
            ->leftJoin('DanhMuc as dm', 'dm.MaDM', '=', 'sp.MaDM')
            ->leftJoin('ThuongHieu as th', 'th.MaTH', '=', 'sp.MaTH')

            // ===== (SUA SO SAO) JOIN RATING =====
            ->leftJoinSub($ratingSub, 'rt', function ($join) {
                $join->on('rt.MaSP', '=', 'sp.MaSP');
            })

            ->leftJoin('BienTheSanPham as bt', function ($join) {
                $join->on('bt.MaSP', '=', 'sp.MaSP')
                    ->where('bt.IsDeleted', 0)
                    ->where('bt.TrangThai', 1);
            })
            ->where('sp.MaSP', $maSP)
            ->where('sp.IsDeleted', 0)
            ->groupBy(
                'sp.MaSP',
                'sp.TenSP',
                'sp.MoTa',
                'sp.TrangThai',
                'sp.MaDM',
                'dm.TenDM',
                'th.TenTH',
                // ===== (SUA SO SAO) GROUP BY RATING =====
                'rt.saoTrungBinh',
                'rt.soLuotDanhGia'
            )
            ->select(
                'sp.MaSP',
                'sp.TenSP',
                'sp.TrangThai',
                'sp.MaDM',
                'sp.MoTa',
                'dm.TenDM as tenDanhMuc',
                'th.TenTH as tenThuongHieu',
                DB::raw('MIN(bt.GiaGoc) as giaMin'),
                DB::raw('MAX(bt.GiaGoc) as giaMax'),

                // ===== (SUA SO SAO) SELECT RATING =====
                DB::raw('COALESCE(rt.saoTrungBinh, 0) as saoTrungBinh'),
                DB::raw('COALESCE(rt.soLuotDanhGia, 0) as soLuotDanhGia')
            )
            ->first();

        // Nếu không tồn tại SP
        if (!$sanPham) {
            abort(404);
        }

        // Hình ảnh
        $hinhAnhs = DB::table('HinhAnhSanPham')
            ->where('MaSP', $maSP)
            ->pluck('DuongDan')
            ->toArray();

        // Biến thể (size)
        $bienThes = DB::table('BienTheSanPham as bt')
            ->join('KichThuoc as kt', 'kt.MaKT', '=', 'bt.MaKT')
            ->where('bt.MaSP', $maSP)
            ->where('bt.IsDeleted', 0)
            ->where('bt.TrangThai', 1)
            ->select(
                'bt.MaBT',
                'kt.TenKT',
                'bt.SoLuong',
                'bt.GiaGoc'
            )
            ->get();

        // Đánh giá
        $danhGias = DB::table('DanhGia as dg')
            ->join('KhachHang as kh', 'kh.MaKH', '=', 'dg.MaKH')
            ->where('dg.MaSP', $maSP)
            // ===== (SUA SO SAO) DONG BO LOC REVIEW =====
            ->orderByDesc('dg.NgayDanhGia')
            ->select(
                'kh.HoTen',
                'dg.SoSao',
                'dg.NoiDung',
                'dg.NgayDanhGia'
            )
            ->paginate(5);

        // ===== (SUA SO SAO) BO DOAN TINH LAI SAO/DEM (DE TRANH LECH) =====
        // $sanPham->soLuotDanhGia = $danhGias->total();
        // $sanPham->saoTrungBinh = DB::table('DanhGia')
        //     ->where('MaSP', $maSP)
        //     ->avg('SoSao') ?? 0;

        //begin phat
        // Tong ton kho (cong tat ca bien the)
        $tongTon = (int) DB::table('BienTheSanPham')
            ->where('MaSP', $maSP)
            ->where('IsDeleted', 0)
            ->where('TrangThai', 1)
            ->sum('SoLuong');

        $sanPham->tongTon = $tongTon;

        // Trang thai hien thi
        if ((int)$sanPham->TrangThai === 0) {
            $sanPham->trangThaiText = 'Tam ngung ban';
        } else {
            $sanPham->trangThaiText = $tongTon > 0 ? 'Con hang' : 'Het hang';
        }

        // Thong so ky thuat
        $thongSos = DB::table('ThongSoSanPham')
            ->where('MaSP', $maSP)
            ->orderBy('SapXep')
            ->orderBy('MaTS')
            ->get();

        // Thong ke: +1 luot xem
        DB::table('ThongKeSanPham')->updateOrInsert(
            ['MaSP' => $maSP],
            ['LuotXem' => DB::raw('COALESCE(LuotXem,0) + 1')]
        );

        $thongKe = DB::table('ThongKeSanPham')->where('MaSP', $maSP)->first();

        // San pham lien quan (cung danh muc)
        $related = DB::table('SanPham as sp')
            ->leftJoin('BienTheSanPham as bt', function ($join) {
                $join->on('bt.MaSP', '=', 'sp.MaSP')
                    ->where('bt.IsDeleted', 0)
                    ->where('bt.TrangThai', 1);
            })
            ->where('sp.IsDeleted', 0)
            ->where('sp.MaDM', $sanPham->MaDM)
            ->where('sp.MaSP', '<>', $maSP)
            ->groupBy('sp.MaSP', 'sp.TenSP')
            ->select(
                'sp.MaSP',
                'sp.TenSP',
                DB::raw('COALESCE(MIN(bt.GiaGoc),0) as giaMin'),

                DB::raw('(
            SELECT ha2.DuongDan
            FROM HinhAnhSanPham ha2
            WHERE ha2.MaSP = sp.MaSP
            ORDER BY ha2.MaHinh ASC
            LIMIT 1
        ) as anhDauTien')
            )
            ->orderByDesc('sp.MaSP')
            ->limit(5)
            ->get();


        return view('products.chi-tiet', compact(
            'sanPham',
            'hinhAnhs',
            'bienThes',
            'danhGias',
            'thongSos',
            'related',
            'thongKe'
        ));
    }

    public function guiDanhGia(Request $request, $maSP)
    {
        $kh = session('khachhang');
        if (!$kh) return redirect('/dang-nhap');

        $request->validate([
            'SoSao' => 'required|integer|min:1|max:5',
            'NoiDung' => 'nullable|string',
        ]);

        $maSP = (int) $maSP;
        $maKH = (int) $kh['MaKH'];

        $daCo = DB::table('DanhGia')->where('MaSP', $maSP)->where('MaKH', $maKH)->first();

        if ($daCo) {
            DB::table('DanhGia')
                ->where('MaSP', $maSP)
                ->where('MaKH', $maKH)
                ->update([
                    'SoSao' => (int) $request->SoSao,
                    'NoiDung' => $request->NoiDung,
                    'NgayDanhGia' => now(),
                ]);
        } else {
            DB::table('DanhGia')->insert([
                'MaSP' => $maSP,
                'MaKH' => $maKH,
                'SoSao' => (int) $request->SoSao,
                'NoiDung' => $request->NoiDung,
                'NgayDanhGia' => now(),
            ]);
        }

        return back()->with('success', 'Da gui danh gia');
    }
}
