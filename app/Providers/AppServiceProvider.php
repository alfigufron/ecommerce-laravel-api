<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

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
    Schema::defaultStringLength(191);

    Blade::directive('rupiah', function($temp) {
      $result = number_format($temp, 0, ',', '.');
      return "<?php echo 'Rp $result'; ?>";
    });
  }
}
