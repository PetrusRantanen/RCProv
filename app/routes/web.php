<?php

use App\Http\Controllers\ScriptExecuteController;
use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::home');
Route::livewire('/cms', 'pages::cms');
Route::livewire('/images', 'pages::images');
Route::livewire('/projects', 'pages::projects');
Route::livewire('/firmwares', 'pages::firmwares');
Route::livewire('/scripts', 'pages::scripts');
Route::livewire('/labels', 'pages::labels');
Route::livewire('/settings', 'pages::settings');

// Script execute
Route::any('/scriptexecute', ScriptExecuteController::class);
