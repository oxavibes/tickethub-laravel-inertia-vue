<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(UrlGenerator $url): void
	{
		if (env('APP_ENV') == 'production') {
			$url->forceScheme('https');
		}

		JsonResource::withoutWrapping();
	}
}
