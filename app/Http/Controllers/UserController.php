<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json([
            "code" => 200,
            "data" => new UserResource($user)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, User $user)
    {
        try {
            $user->update([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password)
            ]);

            return response()->json([
                "code" => 200,
                "status" => true,
                "message" => "Sukses mengubah data siswa!"
            ]);
        } catch(\Error $e) {
            return response()->json([
                "code" => 400,
                "status" => false,
                "message" => "Gagal mengubah data siswa!"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();

            return response()->json([
                "code" => 200,
                "status" => true,
                "message" => "Sukses menghapus data siswa!"
            ]);
        } catch(\Error $e) {
            return response()->json([
                "code" => 400,
                "status" => false,
                "message" => "Gagal menghapus data siswa!"
            ]);
        }
    }
}
