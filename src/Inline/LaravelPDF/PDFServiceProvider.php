<?php namespace Inline\LaravelPDF;


//use Config;

use Illuminate\Support\ServiceProvider;

class PDFServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
    $this->publishConfiguration();
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

    $this->app->singleton('pdf', function($app)
    {
      return new PDF(config('laravelpdf.executable'), storage_path());
    });


	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('pdf');
	}


  /**
   * Publish configuration file
   */
  private function publishConfiguration()
  {
    $this->publishes([__DIR__ . '/../../config/laravelpdf.php' => config_path('laravelpdf.php')], 'config');
    $this->mergeConfigFrom(__DIR__ . '/../../config/laravelpdf.php', 'laravelpdf');
  }

}