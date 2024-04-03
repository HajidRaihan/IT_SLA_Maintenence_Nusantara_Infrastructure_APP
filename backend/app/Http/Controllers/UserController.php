<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();

        return response()->json($user);
    }

    public function updateProfile(Request $request, $id)
    {
        $validate = $request->validate([
            'username' => 'nullable|string',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Sesuaikan dengan tipe file yang diizinkan dan batas ukuran file
            'ttd' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Sesuaikan dengan tipe file yang diizinkan dan batas ukuran file
        ]);

        $ttdName = null;

        if ($request->ttd->isValid()) {
            $originalName = $request->ttd->getClientOriginalName();
            $fileExtension = $request->ttd->getClientOriginalExtension();
            $ttdName = Date::now()->format('YmdHis') . '-' . $originalName;
            Storage::putFileAs('image', $request->ttd, $ttdName);
        }

        $fileName = null;

        if ($request->foto->isValid()) {
            $originalName = $request->foto->getClientOriginalName();
            $fileExtension = $request->foto->getClientOriginalExtension();
            $fileName = Date::now()->format('YmdHis') . '-' . $originalName;
            Storage::putFileAs('image', $request->foto, $fileName);
        }

        $user = User::where('id', $id)->update([
            'username' => $request->username,
            'email' => $request->email,
            'foto' => $fileName,
            'ttd' => $ttdName,
        ]);

        if (!$user) {
            return response()->json([
                'message' => 'Update failed',
            ], 404);
        }

        return response()->json([
            'message' => 'Update success',
        ], 200);
    }

    
    
}
