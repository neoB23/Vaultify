<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasswordRecord;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    public function index()
    {
        $passwords = PasswordRecord::where('user_id', Auth::id())->get();
        return view('passwords.index', compact('passwords'));
    }

    public function create()
    {
        return view('passwords.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        PasswordRecord::create([
            'user_id' => Auth::id(),
            'title' => $request->site_name,
            'username' => $request->username,
            'password' => $request->password, // You should encrypt this
            'notes' => $request->notes,
        ]);

        return redirect()->route('passwords.index')->with('status', 'Password saved!');
    }
}
