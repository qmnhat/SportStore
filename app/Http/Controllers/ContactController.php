<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
class ContactController extends Controller
{
    //
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10'
        ]);

        // Lưu vào database
        Contact::create($validated);

        return redirect()->back()->with('success', 'Cảm ơn! Chúng tôi sẽ liên hệ lại bạn sớm.');
    }
}
