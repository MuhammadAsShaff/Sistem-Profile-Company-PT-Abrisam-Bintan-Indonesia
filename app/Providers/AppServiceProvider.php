<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;  // Pastikan ini ditambahkan

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('dashboard.sidebar', function ($view) {
            $admin = Auth::guard('admin')->user(); // Hanya ambil admin yang sedang login
            if ($admin) {
                $view->with('admin', $admin);
            }
        });

    }   
}
