<?php

namespace App\Integrations\TelegramApi\Requests;


use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\SoloRequest;
use Saloon\Traits\Body\HasFormBody;

class SetWebHookRequest extends SoloRequest implements HasBody
{
    use HasFormBody;

    public function __construct(
        protected readonly ?string $token = null,
        protected readonly ?string $url = null,
        protected readonly ?string $certificate = null,
        protected readonly ?string $ipAddress = null,
        protected readonly int $maxConnections = 40,
        protected readonly ?array $allowedUpdates = null,
        protected readonly bool $dropPendingUpdates = false,
        protected ?string $secretToken = null,
    ) {
        //
    }
    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        $token = $this->token ?? config(key: 'services.telegram-bot-api.token');
        $url = "https://api.telegram.org/bot$token/setWebhook";
        return $url;
    }

    public function defaultBody(): array
    {
        $secretToken = $this->secretToken ?? config(key: 'services.telegram-bot-api.webhook_token');
        $url =  $this->url ?? config(key: 'services.ngrok.url');

        $params = [
            'url' => "$url/webhook",
            'certificate' => $this->certificate,
            'ip_address' => $this->ipAddress,
            'max_connections' => $this->maxConnections,
            'allowed_updates'=> $this->allowedUpdates,
            'drop_pending_updates' => $this->dropPendingUpdates,
            'secret_token' => $secretToken,
        ];

        $validParams = array_filter(
            array: $params,
            callback: fn($value): bool => $value  !== null && $value !== ''
        );

        return $validParams;
    }
}
