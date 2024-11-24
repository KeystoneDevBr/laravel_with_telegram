<?php

namespace App\Http\Controllers\TelegramApi\Types;

use App\Http\Controllers\TelegramApi\Types\MessageEntityDTO as MessageEntity;

/**
 * This object represents reply parameters for the message being sent.
 * Saiba mais em: https://core.telegram.org/bots/api#replyparameters
 */
class ReplyParametersDTO
{
    public int $message_id;
    public int|string|null $chat_id;
    public bool $allow_sending_without_reply = true;
    public ?string $quote;
    public ?string $quote_parse_mode;
    /**
     * Summary of quote_entities
     * @var MessageEntity[];
     */
    public ?array $quote_entities;
    public ?int $quote_position;

    public function __construct(array $parameters)
    {
        $this->message_id = $parameters['message_id'];
        $this->chat_id = $parameters['chat_id'] ?? null;
        $this->allow_sending_without_reply = $parameters['allow_sending_without_reply'] ?? false;
        $this->quote = $parameters['quote'] ?? null;
        $this->quote_parse_mode = $parameters['quote_parse_mode'] ?? null;
        $this->quote_entities = $parameters['quote_entities'] ?? null; 
        $this->quote_position = $parameters['quote_position'] ?? null;
    }
}
