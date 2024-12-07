<?php

use App\Http\Controllers\EntrepriseController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EntrepriseController::class, 'index'])->name('home');
Route::get('/search/form', [EntrepriseController::class, 'showSearchForm'])->name('search.form');
Route::get('/search/results', [EntrepriseController::class, 'search'])->name('search.results');
