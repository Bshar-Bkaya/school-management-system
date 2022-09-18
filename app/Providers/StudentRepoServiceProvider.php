<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class StudentRepoServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind('App\Repository\Interfaces\StudentRepoInterface', 'App\Repository\Classes\StudentRepo');
    $this->app->bind('App\Repository\Interfaces\PromotionRepoInterface', 'App\Repository\Classes\PromotionRepo');
    $this->app->bind('App\Repository\Interfaces\GraduatedRepoInterface', 'App\Repository\Classes\GraduatedRepo');
    $this->app->bind('App\Repository\Interfaces\FeeRepoInterface', 'App\Repository\Classes\FeeRepo');
    $this->app->bind('App\Repository\Interfaces\FeeInvoiceRepoInterface', 'App\Repository\Classes\FeeInvoiceRepo');
    $this->app->bind('App\Repository\Interfaces\ReceiptStudentRepoInterface', 'App\Repository\Classes\ReceiptStudentRepo');
    $this->app->bind('App\Repository\Interfaces\ProcessingFeeRepoInterface', 'App\Repository\Classes\ProcessingFeeRepo');
    $this->app->bind('App\Repository\Interfaces\PaymentRepoInterface', 'App\Repository\Classes\PaymentRepo');
    $this->app->bind('App\Repository\Interfaces\AttendanceRepoInterface', 'App\Repository\Classes\AttendanceRepo');
    $this->app->bind('App\Repository\Interfaces\SubjectRepoInterface', 'App\Repository\Classes\SubjectRepo');
    $this->app->bind('App\Repository\Interfaces\QuizzRepositoryInterface', 'App\Repository\Classes\QuizzRepository');
    $this->app->bind('App\Repository\Interfaces\QuestionRepoInterface', 'App\Repository\Classes\QuestionRepo');
    $this->app->bind('App\Repository\Interfaces\LibraryRepoInterface', 'App\Repository\Classes\LibraryRepo');
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
