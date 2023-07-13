<?php

namespace App\Providers;

use App\Models\Guestpage;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


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
      Paginator::useBootstrap();

      $address = Guestpage::where('title', 'address')->first();
      $contact = Guestpage::where('title', 'contact us')->first();
      $email_us = Guestpage::where('title', 'email us')->first();
      View::share('address_clinic', $address);
      View::share('contact_us', $contact);
      View::share('email_us', $email_us);

    }
}
