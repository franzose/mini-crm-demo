<?php

namespace CrmDemo\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider {

	public function boot()
	{
		/* @set($var = VALUE) */
		Blade::directive('set', function($expr) {
			return "<?php {$expr} ?>";
		});

		/* @dump($var) */
		Blade::directive('dump', function($expr) {
			return "<?php var_dump({$expr}) ?>";
		});

		/* @dd($var) */
		Blade::directive('dd', function($expr) {
			return "<?php dd({$expr}) ?>";
		});
	}

	public function register()
	{
		//
	}
}