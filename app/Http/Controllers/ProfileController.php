<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        try {
            $user = Auth::user();
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user->name = $request->name;

            if ($user->save()) {
                return redirect()->route('profile.edit')->with('success', 'Nama profil berhasil diperbarui!');
            }
            
            return redirect()->back()->with('error', 'Gagal memperbarui profil.');
            
        } catch (\Exception $e) {
            \Log::error('Profile update exception: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}