<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::resource("contact", ContactController::class);
