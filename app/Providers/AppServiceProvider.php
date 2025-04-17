<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\AdminsTaiKhoan;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider

{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $admin = session('admin_id') ? AdminsTaiKhoan::find(session('admin_id')) : null;
            $view->with('admin', $admin);
        });
    }
}
