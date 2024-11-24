<?php

namespace App\Integrations\TelegramApi\Requests;

use App\Http\Controllers\TelegramApi\Types\InlineKeyboardMarkup;
use App\Http\Controllers\TelegramApi\Types\LinkPreviewOptionsDTO as LinkPreviewOptions;
use App\Http\Controllers\TelegramApi\Types\MessageEntityDTO as MessageEntity;
use App\Http\Controllers\TelegramApi\Types\ReplyKeyboardMarkupDTO as ReplyKeyboardMarkup;
use App\Http\Controllers\TelegramApi\Types\ReplyParametersDTO as ReplyParameters;
use Masterminds\HTML5\Entities;
use PHPUnit\Framework\Constraint\IsInstanceOf;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\SoloRequest;
use Saloon\Traits\Body\HasFormBody;

class SendMessageRequest extends SoloRequest implements HasBody
{
    use HasFormBody;

    public function __construct(
        protected readonly string $chatId,
        protected readonly string $text,
        protected readonly ?string $token = null,
        protected readonly ?int $messageThreadId = null,
        protected readonly ?string $parseMode = null,
        protected readonly ?MessageEntity $entities = null,
        protected readonly ?LinkPreviewOptions $linkPreviewOptions = null,
        protected readonly bool $disableNotification = false,
        protected readonly bool $protectContent = false,
        protected readonly bool $allowPaidBroadcast = false,
        protected readonly ?string $messageEffectId = null,
        protected readonly ?ReplyParameters $replyParameters = null,
        protected readonly InlineKeyboardMarkup | ReplyKeyboardMarkup | null $replyMarkup = null,
        // ReplyKeyboardMarkup or 
        // ReplyKeyboardRemove or ForceReply
    ) {
        //
    }

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        $token = $this->token ?? config(key: 'services.telegram-bot-api.token');
        return "https://api.telegram.org/bot$token/sendMessage";
    }

    public function defaultBody(): array
    {
        $params = [
            'chat_id' => $this->chatId,
            'text' => $this->text,
            'message_thread_id' => $this->messageThreadId,
            'parse_mode' => $this->parseMode,
            'entities' => collect($this->entities)->every(fn($entity) => $entity instanceof MessageEntity)
                ? json_encode($this->entities)
                : null,
            'link_preview_options' => $this->linkPreviewOptions instanceof LinkPreviewOptions ? json_encode($this->linkPreviewOptions) : null,
            'disable_notification' => $this->disableNotification,
            'protect_content' => $this->protectContent,
            'allow_paid_broadcast' => $this->allowPaidBroadcast,
            'message_effect_id' => $this->messageEffectId,
            'reply_parameters' => $this->replyParameters instanceof ReplyParameters ? json_encode($this->replyParameters) : null,
            // Precisa ser aprimorado para validar os 4 tipos de classe restante
            // 'reply_markup' => match(true){
            //     $this->replyMarkup instanceof InlineKeyboardMarkup =>  json_encode($this->replyMarkup), 
            //     $this->replyMarkup instanceof ReplyKeyboardMarkup =>   json_encode($this->replyMarkup),
            //     default => null,
            // }
            'reply_markup'=> json_encode($this->replyMarkup)
        ];

        return array_filter(
            array: $params,
            callback: fn($value) => $value !== null && $value !== ''
        );
    }
}
