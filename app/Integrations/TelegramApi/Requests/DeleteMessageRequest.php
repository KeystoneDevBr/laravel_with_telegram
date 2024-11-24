<?php

namespace App\Integrations\TelegramApi\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\SoloRequest;
use Saloon\Traits\Body\HasFormBody;

class DeleteMessageRequest extends SoloRequest implements HasBody
{
    use HasFormBody;

    public function __construct(
        protected readonly string $chatId,
        protected readonly int $messageId,
        protected readonly ?string $token = null,
    ) {
        //
    }

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        $token = $this->token ?? config(key: 'services.telegram-bot-api.token');
        return "https://api.telegram.org/bot$token/deleteMessage";
    }

    public function defaultBody(): array
    {
        $params = [
            'chat_id' => $this->chatId,
            'message_id'=>$this->messageId,
        ];

        return $params;
    }
}
