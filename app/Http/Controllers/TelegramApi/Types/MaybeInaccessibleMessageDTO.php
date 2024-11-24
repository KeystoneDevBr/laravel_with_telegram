<?php

namespace App\Http\Controllers\TelegramApi\Types;


use App\Http\Controllers\TelegramApi\Types\InaccessibleMessageDTO as InaccessibleMessage;
use App\Http\Controllers\TelegramApi\Types\MessageDTO as Message;

/**
 * This object describes a message that can be inaccessible to the bot. It can be one of
 *  Saiba mais: https://core.telegram.org/bots/api#maybeinaccessiblemessage
 */
class MaybeInaccessibleMessageDTO 
{
    public Message | InaccessibleMessage $message;
    public function __construct(Message | InaccessibleMessage $message){
        $this->message = $message;
    }
}