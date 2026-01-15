<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
class AdminContactController extends Controller
{
    //danh sachs liene he
    public function index(){
        $contacts = Contact::orderBy('created_at','desc')->paginate(10);
        return view('admin.contacts.index',compact('contacts'));
    }
    //xem chi tiết liên hệ
    public function show($id){
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.show',compact('contact'));
    }
    //cập nhật trạng thái liên hệ
    public function update(Request $request, $id){
        $contact = Contact::findOrFail($id);
        $contact->update(['status' => $request->input('status')]);
        return redirect()->back()->with('success','Cập nhật trạng thái liên hệ thành công');
    }
    //xóa liên hệ
    public function destroy($id){
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success','Xóa liên hệ thành công');
    }
}
