<?php

namespace App\Integrations\TelegramApi\Requests;

use Saloon\Enums\Method;
use Saloon\Http\SoloRequest;

class GetMeRequest extends SoloRequest
{
    public function __construct(
        protected readonly ?string $token = null
    ) {
        //
    }
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        $token = $this->token ?? config(key: 'services.telegram-bot-api.token');

        return "https://api.telegram.org/bot$token/getMe";
    }
}