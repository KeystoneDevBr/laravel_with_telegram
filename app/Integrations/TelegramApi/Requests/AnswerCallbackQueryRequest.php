<?php

namespace App\Integrations\TelegramApi\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\SoloRequest;
use Saloon\Traits\Body\HasFormBody;

class AnswerCallbackQueryRequest extends SoloRequest implements HasBody
{

    use HasFormBody;

    public function __construct(
        protected readonly string $calback_query_id,
        protected readonly ?string $text = null,
        protected readonly ?string $url = null,
        protected readonly ?int $cache_time = null,
        protected readonly bool $show_alert = false,
        protected readonly ?string $token = null,
    ) {
        //
    }
    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        $token = $this->token ?? config('services.telegram-bot-api.token');

        return "https://api.telegram.org/bot$token/answerCallbackQuery";
    }

    public function defaultBody(): array
    {
        
        $queryParams = [
            'callback_query_id' => $this->calback_query_id,
            'text' => $this->text,
            'show_alert' => $this->show_alert,
            'url' => $this->url,
            'cache_time' => $this->cache_time
        ];

        $validParams = array_filter(array: $queryParams, callback: function ($value): bool {
            return $value !== null && $value !== '';
        });

        return $validParams;
    }
}
