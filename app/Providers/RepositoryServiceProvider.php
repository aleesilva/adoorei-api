<?php

namespace App\Providers;

use Core\Repository\IProductRepository;
use Core\Repository\ISaleRepository;
use Core\Repository\ProductRepository;
use Core\Repository\SaleRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    private array $repositories = [
        IProductRepository::class => ProductRepository::class,
        ISaleRepository::class    => SaleRepository::class,
    ];

    public function register(): void
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
