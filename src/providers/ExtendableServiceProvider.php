<?php
/**
 * Created by PhpStorm.
 * User: antonpauli
 * Date: 30/07/15
 * Time: 14:09
 */

namespace Trexology\Extendable\Providers;

use Illuminate\Support\ServiceProvider;

class ExtendableServiceProvider extends ServiceProvider
{
    // protected $defer = true;

    public function boot()
    {

      // Publish migrations
      $this->publishes([
          __DIR__.'/../migrations/' => database_path('migrations')
      ], 'migrations');

      // Publish configuration
      $this->publishes([
          __DIR__.'/../config/custom-fields.php' => config_path('custom-fields.php'),
      ], 'config');
    }

    public function register()
    {
    }

    public function when()
    {
        return array('artisan.start');
    }
}
