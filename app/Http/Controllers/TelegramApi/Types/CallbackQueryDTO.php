<?php

namespace App\Http\Controllers\TelegramApi\Types;

use App\Http\Controllers\TelegramApi\Types\UserDTO as User;
use App\Http\Controllers\TelegramApi\Types\MaybeInaccessibleMessageDTO as MaybeInaccessibleMessage;

class CallbackQueryDTO
{
    public string $id;
    public User $from;
    public ?MaybeInaccessibleMessage $message;
    public ?string $inline_message_id;
    public string $chat_instance;
    public ?string $data;
    public ?string $game_short_name;

    public function __construct(array $callbackQuery)
    {
        $this->id = $callbackQuery['id'];
        $this->from = new User($callbackQuery['from']);
        $this->message = isset($callbackQuery['message']) ?
            new MaybeInaccessibleMessage(new MessageDTO($callbackQuery['message'])) :
            new MaybeInaccessibleMessage(new InaccessibleMessageDTO([
                'from' => $callbackQuery['from'],
                'message_id' => $callbackQuery['message_id'],
                'date' => $callbackQuery['date']
            ]));
        $this->inline_message_id = $callbackQuery['inline_message_id'] ?? null;
        $this->chat_instance = $callbackQuery['chat_instance'];
        $this->data = $callbackQuery['data'] ?? null;
        $this->game_short_name = $callbackQuery['game_short_name'] ?? null;
    }
}
