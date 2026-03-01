<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasswordRecord;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    public function index(Request $request)
    {
        $query = PasswordRecord::where('user_id', Auth::id());

        // Search — fields are encrypted so we filter in PHP after fetch
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $passwords = $query->latest()->get()->filter(function ($pw) use ($search) {
                return str_contains(strtolower($pw->title ?? ''), $search)
                    || str_contains(strtolower($pw->username ?? ''), $search)
                    || str_contains(strtolower($pw->url ?? ''), $search);
            })->values();
        } else {
            $passwords = $query->latest()->get();
        }

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
            'username'  => 'required|string|max:255',
            'password'  => 'required|string|max:255',
            'url'       => 'nullable|url|max:2048',
            'notes'     => 'nullable|string|max:5000',
        ]);

        PasswordRecord::create([
            'user_id'  => Auth::id(),
            'title'    => $request->site_name,
            'username' => $request->username,
            'password' => $request->password,
            'url'      => $request->url,
            'notes'    => $request->notes,
        ]);

        return redirect()->route('passwords.index')->with('status', 'Password saved successfully!');
    }

    public function update(Request $request, PasswordRecord $passwordRecord)
    {
        if ($passwordRecord->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'site_name' => 'required|string|max:255',
            'username'  => 'required|string|max:255',
            'password'  => 'nullable|string|max:255',
            'url'       => 'nullable|url|max:2048',
            'notes'     => 'nullable|string|max:5000',
        ]);

        $data = [
            'title'    => $request->site_name,
            'username' => $request->username,
            'url'      => $request->url,
            'notes'    => $request->notes,
        ];

        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        $passwordRecord->update($data);

        return redirect()->route('passwords.index')->with('status', 'Password updated successfully!');
    }

    /**
     * Return decrypted password via authenticated JSON endpoint.
     */
    public function reveal(PasswordRecord $passwordRecord)
    {
        if ($passwordRecord->user_id !== Auth::id()) {
            abort(403);
        }

        return response()->json([
            'password' => $passwordRecord->password,
        ]);
    }

    /**
     * Toggle the favorite status of a password record.
     */
    public function toggleFavorite(PasswordRecord $passwordRecord)
    {
        if ($passwordRecord->user_id !== Auth::id()) {
            abort(403);
        }

        $passwordRecord->update(['favorite' => !$passwordRecord->favorite]);

        return response()->json(['favorite' => $passwordRecord->favorite]);
    }

    public function destroy(PasswordRecord $passwordRecord)
    {
        if ($passwordRecord->user_id !== Auth::id()) {
            abort(403);
        }

        $passwordRecord->delete();

        return redirect()->route('passwords.index')->with('status', 'Password deleted successfully!');
    }
}
