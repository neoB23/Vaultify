<?php
namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;

class AccountController extends Controller
{
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('status', 'Password changed successfully!');
    }

    public function enable2FA(): RedirectResponse
    {
        return redirect()->route('two-factor.show');
    }

    public function disable2FA(DisableTwoFactorAuthentication $disableTwoFactorAuthentication): RedirectResponse
    {
        $disableTwoFactorAuthentication(Auth::user());

        return back()->with('success', 'Two-factor authentication has been disabled.');
    }
}
