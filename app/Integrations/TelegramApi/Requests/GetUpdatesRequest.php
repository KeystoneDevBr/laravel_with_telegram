<?php

namespace App\Integrations\TelegramApi\Requests;

use App\Integrations\TelegramApi\ResponseTypes\GetUpdatesResponseDTO;
use Saloon\Enums\Method;
use Saloon\Http\Response;
use Saloon\Http\SoloRequest;

class GetUpdatesRequest extends SoloRequest
{
    public function __construct(
        protected readonly ?string $token = null
    ) {
        //
    }
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        $token = $this->token ?? config('services.telegram-bot-api.token');

        return "https://api.telegram.org/bot$token/getUpdates";
    }

    /**
     *  Create a DTO from the response
     * @param \Saloon\Http\Response $response
     * @return mixed
     */
    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        return new GetUpdatesResponseDTO(
            ok: $data['ok'],
            error_code: $data['error_code'] ?? null,
            description: $data['description'] ?? null,
            results: $data['result'] ?? null
        );
    }
}