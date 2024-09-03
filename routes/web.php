<?php

use App\Http\Controllers\DropdownController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('dropdown', [DropdownController::class, 'index']);
Route::post('api/fetch-districts', [DropdownController::class, 'fetchDistrict']);
Route::post('api/fetch-upazilas', [DropdownController::class, 'fetchUpazila']);
Route::post('api/fetch-unions', [DropdownController::class, 'fetchUnion']);
Route::post('/submit', [DropdownController::class, 'submit'])->name('submit');
