<?php
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Http::macro('api', function () {
            return Http::withHeaders([
                'Accept' => 'application/json',
            ])->baseUrl(config('services.api.base_uri'));
        });
    }
}