<?php

namespace App\Providers;

use App\Models\Admin\Category;
use App\Models\Admin\Client;
use App\Models\Admin\IndustryServe;
use App\Models\Admin\Product;
use App\Models\Admin\SocialLink;
use App\Models\Admin\WhyChooseUs;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // product for menu for menu
        $products = Product::where('is_menu',1)->with('keyFeature')->get();

        // footer social link
        $socialLinks = SocialLink::get();
        // product category for our service menu
        $productCategories = Category::get();

        // industry we serve
        $industryServeGlobal = IndustryServe::get();
        // why choose us for globally
        $whyChooseUsItems = WhyChooseUs::get();
        // our client for globally
        $ourClients = Client::get();

        View::share('products', $products);
        View::share('socialLinks', $socialLinks);
        View::share('productCategories', $productCategories);
        View::share('industryServeGlobal', $industryServeGlobal);
        View::share('whyChooseUsItems', $whyChooseUsItems);
        View::share('ourClients', $ourClients);
    }
}
