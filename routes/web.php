<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('mail-variable-list', [\App\Http\Controllers\MailVariableController::class, 'index'])->name('mail-variable.index');
Route::get('mail-variable-create/{id}', [\App\Http\Controllers\MailVariableController::class, 'create'])->name('mail-variable.create');
Route::post('mail-variable-updateOrCreate/{id}', [\App\Http\Controllers\MailVariableController::class, 'updateOrCreate'])->name('mail-variable.updateOrCreate');
Route::get('mail-variable-delete/{id}', [\App\Http\Controllers\MailVariableController::class, 'delete'])->name('mail-variable.delete');


Route::get('email-template-list', [\App\Http\Controllers\EmailTemplateController::class, 'index'])->name('mail-template.index');
Route::get('email-template-create/{id}', [\App\Http\Controllers\EmailTemplateController::class, 'create'])->name('mail-template.create');
Route::post('email-template-updateOrCreate/{id}', [\App\Http\Controllers\EmailTemplateController::class, 'updateOrCreate'])->name('email-template.updateOrCreate');
Route::get('email-template-delete/{id}', [\App\Http\Controllers\EmailTemplateController::class, 'delete'])->name('email-template.delete');
