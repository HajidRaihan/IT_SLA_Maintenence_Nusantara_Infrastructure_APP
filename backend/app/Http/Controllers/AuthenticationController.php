<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    //
    public function login(Request $request) {
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required '
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        return response()->json([
            'message' => 'Login success',
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function register(Request $request) {
        $validate = $request->validate([
            'username' => 'required',
            // 'foto' => 'required',
            // 'ttd' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'username' => $request->username,
            // 'foto' => $request->foto,
            // 'ttd' => $request->ttd,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        return response()->json([
            'message' => 'Register success',
            'user' => $user
        ], 200);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logout success'
        ]);
    }

    public function user() {
        return response(Auth::user());
    }
}
