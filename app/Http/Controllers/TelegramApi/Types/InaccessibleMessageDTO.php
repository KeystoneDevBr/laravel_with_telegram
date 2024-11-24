<?php

namespace App\Http\Controllers\TelegramApi\Types;

use App\Http\Controllers\TelegramApi\Types\ChatDTO as Chat;

/**
 * This object describes a message that was deleted or is otherwise inaccessible to the bot.
 * saiba mais em https://core.telegram.org/bots/api#inaccessiblemessage
 */
class InaccessibleMessageDTO
{
    public Chat $chat;
    public int $message_id;
    public int $date;

    public function __construct(array $inaccessibleMessage)
    {
        $this->chat = new Chat($inaccessibleMessage['from']);
        $this->message_id = $inaccessibleMessage['message_id'];
        $this->date = $inaccessibleMessage['date'];
    }
}
