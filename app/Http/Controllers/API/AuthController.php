<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\{
    Validator,
    Hash
};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // create validator
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|email|max:255|unique:users",
            "password" => "required|string|min:8",
            "role" => "required|string"
        ]);

        // jika ada salah satu syarat dari validasi tidak terpenuhi, maka kembalikan error
        if($validator->fails())
        {
            return response()->json([
                "code" => 401,
                "message" => [...$validator->errors()->toArray()]
            ]);
        }

        // buat user baru
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => $request->role
        ]);

        // buat token untuk user
        $token = $user->createToken("auth_token")->plainTextToken;

        // kembalikan nilai JSON
        return response()->json([
            "code" => 200,
            "data" => $user->only("name", "email", "role"),
            "access_token" => $token,
            "token_type" => "Bearer"
        ]);
    }

    public function login(Request $request)
    {
        // jika tidak ada user dengan data email dan password yang dikirimkan
        if( ! auth()->attempt($request->only("email", "password")) )
        {
            return response()->json([
                "code" => 401,
                "message" => "Unauthorized"
            ], 401);
        }

        // cari user dengan email yang dikirimkan
        $user = User::where("email", $request->email)->firstOrFail();

        // buat token
        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "code" => 200,
            "access_token" => $token,
            "token_type" => "Bearer"
        ]);
    }

    public function logout()
    {
        // hapus token
        auth()->user()->tokens()->delete();

        return response()->json([
            "code" => 200,
            "message" => "you have successfully logout"
        ]);
    }
}
