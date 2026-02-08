<?php 
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class VoyagerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \Event::listen('voyager.menu.admin', function ($menu) {
            $menu[] = [
                'text' => 'Моя страница',
                'url' => '/admin/custom-action',
                'icon' => 'voyager-settings',
            ];
            return $menu;
        });
    }

    public function register()
    {
    }
}