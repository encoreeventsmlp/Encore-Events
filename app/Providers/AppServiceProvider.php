<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
  public function register(): void
  {
  }

  public function boot(): void
  {
    \Illuminate\Pagination\Paginator::defaultView('pagination.bootstrap-5');

    Blade::directive('money', function ($expression) {
      return "<?php echo '₹' . number_format((float)($expression), 2); ?>";
    });
  }
}
