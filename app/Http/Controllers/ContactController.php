<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $messages = \App\Models\ContactMessage::latest()->paginate(20);
        return view('admin.contacts.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:2000',
        ]);

        \App\Models\ContactMessage::create($request->all());

        return redirect()->back()->with('success', 'تم إرسال رسالتك بنجاح! سنتواصل معك قريباً.');
    }
}
