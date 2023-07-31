<?php

namespace App\Providers\Admin;

use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\ServiceProvider;

class AppContentProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @param ViewFactory $view
     * @return void
     */
    public function boot(ViewFactory $view)
    {
        $view->composer([
            'admin.products.product-sidebar',
            'admin.products.product-index',
            'admin.products.index',
            'admin.products.single-product-item'
        ],
            'App\Http\ViewComposers\ProductSidebarComposer'
        );

        $view->composer(
            '*',
            'App\Http\ViewComposers\FrontEndMenuComposer'
        );
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
