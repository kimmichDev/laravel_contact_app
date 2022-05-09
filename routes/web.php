<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\MiscController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware("auth")->group(function () {
    Route::get("/", fn () => redirect()->route("contact.index"));
    Route::resource("contact", ContactController::class);
    Route::get("trash", [MiscController::class, 'showTrash'])->name("showTrash");
    Route::delete("trash/{id}", [MiscController::class, 'permanentDelete'])->name("permanentDelete");
    Route::delete("bulkDelete", [MiscController::class, 'bulkDelete'])->name("bulkDelete");
    Route::delete("bulkAction", [MiscController::class, 'bulkAction'])->name('bulkAction');
    Route::post("/send", [MiscController::class, 'sendContact'])->name('sendContact');
    Route::get("/contactQueue", [MiscController::class, 'contactQueue'])->name('contactQueue');
    Route::post("/contact/accept", [MiscController::class, 'acceptContact'])->name('contact.accept');
    Route::post("/contact/deny", [MiscController::class, 'denyContact'])->name('contact.deny');
});
