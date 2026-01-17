<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function gioiThieu()
    {
        $company = CompanyInfo::find(1);
        return view('pages.gioi-thieu', compact('company'));
    }

    public function about()
    {
        return view('pages.gioi-thieu');
    }

    public function home()
    {
        $sanPhams = DB::table('SanPham as sp')
            ->leftJoin('BienTheSanPham as bt', function ($join) {
                $join->on('bt.MaSP', '=', 'sp.MaSP')
                    ->where('bt.IsDeleted', 0)
                    ->where('bt.TrangThai', 1);
            })
            ->leftJoin('HinhAnhSanPham as ha', 'ha.MaSP', '=', 'sp.MaSP')
            ->where('sp.IsDeleted', 0)
            ->groupBy('sp.MaSP', 'sp.TenSP')
            ->select(
                'sp.MaSP',
                'sp.TenSP',
                DB::raw('MIN(bt.GiaGoc) as giaMin'),
                DB::raw('MIN(ha.DuongDan) as anhDauTien')
            )
            ->orderByDesc('sp.MaSP')
            ->limit(8)
            ->get();

        return view('pages.trang-chu', compact('sanPhams'));
    }
}
