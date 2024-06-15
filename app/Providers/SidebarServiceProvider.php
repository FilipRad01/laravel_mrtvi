<?php

namespace App\Providers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('components.sidebar',function ($view) {
            $courses = Course::with(['users' => fn ($query) => $query->where('users.id', Auth::user()->id)])->get();
            $view->with(['courses'=> $courses]);
        });
    }

    
}
