<?php

namespace App\Integrations\TelegramApi\Requests;

use App\Http\Controllers\TelegramApi\Types\InlineKeyboardMarkup;
use App\Http\Controllers\TelegramApi\Types\LinkPreviewOptionsDTO as LinkPreviewOptions;
use App\Http\Controllers\TelegramApi\Types\MessageEntityDTO as MessageEntity;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\SoloRequest;
use Saloon\Traits\Body\HasFormBody;

class EditMessageTextRequest extends SoloRequest implements HasBody
{
    use HasFormBody;

    public function __construct(
        protected readonly string $text,
        protected readonly ?string $chatId = null,
        protected readonly ?int $messageId = null,
        protected readonly ?string $businessConnectionId = null,
        protected readonly ?string $inlineMessageId = null,
        protected readonly ?string $parseMode = null,
        protected readonly ?array $entities = null, // Array os MessageEntity
        protected readonly ?LinkPreviewOptions $linkPreviewOptions = null,
        protected readonly ?InlineKeyboardMarkup $replyMarkup = null,
        protected readonly ?string $token = null,
    ) {
        //
    }

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        $token = $this->token ?? config(key: 'services.telegram-bot-api.token');
        return "https://api.telegram.org/bot$token/editMessageText";
    }

    public function defaultBody(): array
    {
        $params = [
            'text' => $this->text,
            'chat_id' => $this->chatId,
            'message_id' => $this->messageId,
            'business_connection_id' => $this->businessConnectionId,
            'inline_message_id' => $this->inlineMessageId,
            'parse_mode' => $this->parseMode,
            'entities' => collect($this->entities)->every(fn($entity) => $entity instanceof MessageEntity)
                ? json_encode($this->entities)
                : null,
            'link_preview_options' => $this->linkPreviewOptions instanceof LinkPreviewOptions ? json_encode($this->linkPreviewOptions) : null,
            'reply_markup'=> $this->replyMarkup instanceof InlineKeyboardMarkup? json_encode($this->replyMarkup): null
        ];

        return array_filter(
            array: $params,
            callback: fn($value) => $value !== null && $value !== ''
        );
    }
}
