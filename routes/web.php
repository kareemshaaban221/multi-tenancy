<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('database')->group(function () {
    Route::get('/', function (Request $request) {
        $host = $request->getHost();
        $port = $request->getPort();
        return view('welcome', compact('host', 'port'));
    });

    Route::get('/categories', [CategoryController::class, 'index']);
});
