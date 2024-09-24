<?php

namespace Livro\Providers;

use Illuminate\Support\ServiceProvider;
use Livro\Repositories\AssuntoRepository;
use Livro\Repositories\AutorRepository;
use Livro\Repositories\Interfaces\IAssuntoRepository;
use Livro\Repositories\Interfaces\IAutorRepository;
use Livro\Repositories\Interfaces\ILivroAssuntoRepository;
use Livro\Repositories\Interfaces\ILivroAutorRepository;
use Livro\Repositories\Interfaces\ILivroRepository;
use Livro\Repositories\LivroAssuntoRepository;
use Livro\Repositories\LivroAutorRepository;
use Livro\Repositories\LivroRepository;
use Livro\Services\AssuntoService;
use Livro\Services\AutorService;
use Livro\Services\Interfaces\IAssuntoService;
use Livro\Services\Interfaces\IAutorService;
use Livro\Services\Interfaces\ILivroService;
use Livro\Services\LivroService;

class LivroProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Repositories
        $this->app->bind(IAssuntoRepository::class, AssuntoRepository::class);
        $this->app->bind(IAutorRepository::class, AutorRepository::class);
        $this->app->bind(ILivroAutorRepository::class, LivroAutorRepository::class);
        $this->app->bind(ILivroAssuntoRepository::class, LivroAssuntoRepository::class);
        $this->app->bind(ILivroRepository::class, LivroRepository::class);

        //Services
        $this->app->bind(IAssuntoService::class, AssuntoService::class);
        $this->app->bind(IAutorService::class, AutorService::class);
        $this->app->bind(ILivroService::class, LivroService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
