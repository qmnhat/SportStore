<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyInfo;
class CompanyInfoController extends Controller
{
    // thông tin công ty chỉ có edit và update
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
        $company=CompanyInfo::find(1);
        return view('admin.company_info.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'address' => 'required|string',
            'hotline' => 'required|string',
            'email' => 'required|email',
            'tax_code' => 'nullable|string',
            'opening_hours' => 'nullable|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'employee_count' => 'nullable|integer',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'zalo_phone' => 'nullable|string',
        ]);
        CompanyInfo::find(1)->update($validated);
        return redirect()->back()->with('success','Cập nhật thông tin công ty thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
