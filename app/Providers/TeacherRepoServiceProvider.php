<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TeacherRepoServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind('App\Repository\Interfaces\TeacherRepoInterface', 'App\Repository\Classes\TeacherRepo');
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
    //
  }
}
