<?php

namespace App\Http\Controllers\TelegramApi\Types;

use App\Http\Controllers\TelegramApi\Types\UserDTO as User;

/**
 * This object represents one special entity in a text message. For example, hashtags, usernames, URLs, etc.
 * source: https://core.telegram.org/bots/api#messageentity
 */
class MessageEntityDTO
{
    public string $type;
    public int $offset;
    public int $length;
    public ?string $url;
    public ?User $user;
    public ?string $language;
    public ?string $custom_emoji_id;

    public function __construct(array $messageEntity)
    {
        $this->type = $messageEntity['type'];
        $this->offset = $messageEntity['offset'];
        $this->length = $messageEntity['length'];
        $this->url = $messageEntity['url'] ?? null;
        $this->user = isset($messageEntity['user']) ? new User($messageEntity['user']) : null;
        $this->language = $messageEntity['language'] ?? null;
        $this->custom_emoji_id = $messageEntity['custom_emoji_id'] ?? null;
    }
}