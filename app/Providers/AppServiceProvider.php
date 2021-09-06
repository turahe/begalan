<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Option;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal() && class_exists('Laravel\Telescope\TelescopeServiceProvider')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(\Laravel\Dusk\DuskServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        $filename = storage_path('installed');
        if (file_exists($filename) && Schema::hasTable('categories')) {
            View::share('categories', Category::with('sub_categories')->parent()->get());
        };
//        Membuat Directive Custom Untuk Format Mata Uang

        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format($expression,0,',','.'); ?>";
        });
        $this->themes();
    }

    /**
     * get themes new path themes from resources.
     */
    protected function themes()
    {
        $views = resource_path('themes/'.config('app.theme', 'default'));

        $this->loadViewsFrom($views, 'theme');
    }
}
