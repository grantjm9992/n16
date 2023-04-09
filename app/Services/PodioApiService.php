<?php

namespace App\Services;

use Podio;
use PodioItem;

class PodioApiService
{
    public function __construct()
    {
        $this->authenticate();
    }

    public function getItems(): mixed
    {
        return PodioItem::filter(env('app_id'));
    }

    private function authenticate(): void
    {
        Podio::setup(env('client_id'), env('client_secret'));
        Podio::authenticate_with_app(env('app_id'), env('app_token'));
    }
}
