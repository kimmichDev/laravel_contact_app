<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\MiscController;
use Illuminate\Support\Facades\Route;

Route::resource("contact", ContactController::class);
Route::get("trash", [MiscController::class, 'showTrash'])->name("showTrash");
Route::delete("trash/{id}", [MiscController::class, 'permanentDelete'])->name("permanentDelete");
Route::delete("bulkDelete", [MiscController::class, 'bulkDelete'])->name("bulkDelete");
Route::delete("bulkPermanentDelete", [MiscController::class, 'bulkPermanentDelete'])->name('bulkPermanentDelete');
