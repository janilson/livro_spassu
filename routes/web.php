<?php

use Illuminate\Support\Facades\Route;
use Livro\Http\Controllers\Web\AssuntoController;
use Livro\Http\Controllers\Web\AutorController;
use Livro\Http\Controllers\Web\LivroController;

Route::controller(AssuntoController::class)->group(function () {
    Route::get('assunto', 'index')->name('assunto.index');
    Route::get('assunto/new', 'create')->name('assunto.create');
    Route::get('assunto/{id}', 'show')->name('assunto.show');
    Route::get('assunto/{id}/edit', 'edit')->name('assunto.edit');
    Route::post('assunto', 'store')->name('assunto.store');
    Route::post('assunto/{id}/update', 'update')->name('assunto.update');
    Route::delete('assunto/{id}/delete', 'destroy')->name('assunto.destroy');
});

Route::controller(AutorController::class)->group(function () {
    Route::get('autor', 'index')->name('autor.index');
    Route::get('autor/new', 'create')->name('autor.create');
    Route::get('autor/{id}', 'show')->name('autor.show');
    Route::get('autor/{id}/edit', 'edit')->name('autor.edit');
    Route::post('autor', 'store')->name('autor.store');
    Route::post('autor/{id}/update', 'update')->name('autor.update');
    Route::delete('autor/{id}/delete', 'destroy')->name('autor.destroy');
});

Route::controller(LivroController::class)->group(function () {
    Route::get('livro', 'index')->name('livro.index');
    Route::get('livro/new', 'create')->name('livro.create');
    Route::get('livro/{id}', 'show')->name('livro.show');
    Route::get('livro/{id}/edit', 'edit')->name('livro.edit');
    Route::post('livro', 'store')->name('livro.store');
    Route::post('livro/{id}/update', 'update')->name('livro.update');
    Route::delete('livro/{id}/delete', 'destroy')->name('livro.destroy');
});

Route::get('jasper/report/{name}/{ext?}', [\App\Http\Controllers\Web\JasperController::class, 'report']);
