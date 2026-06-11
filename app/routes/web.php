<?php

use App\Http\Controllers\AddImageController;
use App\Http\Controllers\ScriptExecuteController;
use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::home')->name('home');
Route::livewire('/cms', 'pages::cms')->name('cms');
Route::livewire('/images', 'pages::images')->name('images');
Route::post('/addImage', [AddImageController::class, 'store']);
Route::livewire('/projects', 'pages::projects')->name('projects');
Route::livewire('/firmwares', 'pages::firmwares')->name('firmwares');
Route::livewire('/scripts', 'pages::scripts')->name('scripts');
Route::livewire('/labels', 'pages::labels')->name('labels');
Route::livewire('/settings', 'pages::settings')->name('settings');

// Script execute
Route::any('/scriptexecute', ScriptExecuteController::class);
