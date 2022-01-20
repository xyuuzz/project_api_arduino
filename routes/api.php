<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    ItemController
};
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(["middleware" => "guest"], function() {
    Route::post("register", [AuthController::class, "register"])->name("register");
    Route::post("login", [AuthController::class, "login"])->name("login");
});

Route::group(["middleware" => ["auth:sanctum"]], function() {
    Route::resource("profile", UserController::class)->only([
        "show", "update", "destroy"
    ]);
    Route::resource("item", ItemController::class)->except([
        "create", "edit", "show", "index"
    ]);
    Route::get("{category:id}/item", [ItemController::class, "itemCategory"])->name("item_category");
    Route::post("logout", [AuthController::class, "logout"])->name("logout");
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
