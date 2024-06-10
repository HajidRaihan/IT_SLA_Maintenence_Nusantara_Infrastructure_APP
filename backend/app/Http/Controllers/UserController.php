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

        return response()->json(['message' => 'berhasil menampilkan user', 'data' => $user]);
    }

    public function getById($id)
    {
        $user = User::findOrFail($id);

        return response()->json(['message' => 'berhasil menampilkan user', 'data' => $user]);
    }

    public function updateProfile(Request $request, $id)
    {
        $validate = $request->validate([
            'username' => 'nullable|string',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'ttd' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // Periksa apakah username telah diisi
        if (!$request->filled('username')) {
            return response()->json(
                [
                    'message' => 'Username is required',
                ],
                400,
            ); // Bad Request
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(
                [
                    'message' => 'User not found',
                ],
                404,
            );
        }

        // Update fields if provided in the request
        if ($request->hasFile('foto')) {
            if ($request->foto->isValid()) {
                $originalName = $request->foto->getClientOriginalName();
                $fileExtension = $request->foto->getClientOriginalExtension();
                $fileName = Date::now()->format('YmdHis') . '-' . $originalName;
                $request->foto->move(public_path('images'), $fileName);
                $user->foto = $fileName;
            } else {
                return response()->json(
                    [
                        'message' => 'Invalid photo file',
                    ],
                    400,
                ); // Bad Request
            }
        }

        if ($request->hasFile('ttd')) {
            if ($request->ttd->isValid()) {
                $originalName = $request->ttd->getClientOriginalName();
                $fileExtension = $request->ttd->getClientOriginalExtension();
                $ttdName = Date::now()->format('YmdHis') . '-' . $originalName;
                $request->ttd->move(public_path('images'), $ttdName);
                $user->ttd = $ttdName;
            } else {
                return response()->json(
                    [
                        'message' => 'Invalid signature file',
                    ],
                    400,
                ); // Bad Request
            }
        }

        // Update the username if provided
        $user->username = $request->username;

        // Save the changes to the database
        $user->save();

        return response()->json(
            [
                'message' => 'Update success',
            ],
            200,
        );
    }
}
