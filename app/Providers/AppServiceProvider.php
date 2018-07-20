<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\Models\Config;
use App\Models\Article;
use App\Models\ArticleCategory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $config = Config::get();
        foreach ($config as $k => $v) {
            $config[$v['key']] = $v['value'];
        }
        $help = ArticleCategory::where('parent_id', 6)->limit(4)->get();
        $team = Article::where('position_id', 7)->limit(4)->get();
        View::share('config', $config);
        View::share('team', $team);
        View::share('help', $help);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
