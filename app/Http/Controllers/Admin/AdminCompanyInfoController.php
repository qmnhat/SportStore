<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyInfo;
use App\Models\CompanyPolicy;
use App\Models\CompanyFaq;

class AdminCompanyInfoController extends Controller
{
    // ========== THÔNG TIN CÔNG TY ==========
    public function edit()
    {
        $company = CompanyInfo::find(1);
        return view('admin.company-info.edit', compact('company'));
    }

    public function update(Request $request)
    {
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

    // ========== CHÍNH SÁCH ==========
    public function policiesIndex()
    {
        $policies = CompanyPolicy::orderBy('order')->paginate(10);
        return view('admin.company-info.policies.index', compact('policies'));
    }

    public function policiesCreate()
    {
        return view('admin.company-info.policies.create');
    }

    public function policiesStore(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|in:shipping,payment,return,security',
            'title' => 'required|string',
            'content' => 'required|string',
            'order' => 'nullable|integer',
        ]);

        CompanyPolicy::create($validated);
        return redirect()->route('admin.policies.index')->with('success', 'Tạo chính sách thành công!');
    }

    public function policiesEdit($id)
    {
        $policy = CompanyPolicy::findOrFail($id);
        return view('admin.company-info.policies.edit', compact('policy'));
    }

    public function policiesUpdate(Request $request, $id)
    {
        $policy = CompanyPolicy::findOrFail($id);

        $validated = $request->validate([
            'type' => 'required|string|in:shipping,payment,return,security',
            'title' => 'required|string',
            'content' => 'required|string',
            'order' => 'nullable|integer',
        ]);

        $policy->update($validated);
        return redirect()->route('admin.policies.index')->with('success', 'Cập nhật chính sách thành công!');
    }

    public function policiesDestroy($id)
    {
        $policy = CompanyPolicy::findOrFail($id);
        $policy->delete();
        return redirect()->route('admin.policies.index')->with('success', 'Xóa chính sách thành công!');
    }

    // ========== CÂU HỎI THƯỜNG GẶP ==========
    public function faqsIndex()
    {
        $faqs = CompanyFaq::orderBy('order')->paginate(10);
        return view('admin.company-info.faqs.index', compact('faqs'));
    }

    public function faqsCreate()
    {
        return view('admin.company-info.faqs.create');
    }

    public function faqsStore(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'order' => 'nullable|integer',
        ]);

        CompanyFaq::create($validated);
        return redirect()->route('admin.faqs.index')->with('success', 'Tạo câu hỏi thành công!');
    }

    public function faqsEdit($id)
    {
        $faq = CompanyFaq::findOrFail($id);
        return view('admin.company-info.faqs.edit', compact('faq'));
    }

    public function faqsUpdate(Request $request, $id)
    {
        $faq = CompanyFaq::findOrFail($id);

        $validated = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'order' => 'nullable|integer',
        ]);

        $faq->update($validated);
        return redirect()->route('admin.faqs.index')->with('success', 'Cập nhật câu hỏi thành công!');
    }

    public function faqsDestroy($id)
    {
        $faq = CompanyFaq::findOrFail($id);
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'Xóa câu hỏi thành công!');
    }
}
