<?php

namespace App\Integrations\TelegramApi;
use Saloon\Http\Connector;

class TelegramApiConnector extends Connector
{
    public function resolveBaseUrl(): string
    {
        return 'https://api.telegram.org';
    }
}