<?php

namespace App\Http\Controllers\TelegramApi\Types;

/**
 * This object represents a chat.
 * Saiba mais em https://core.telegram.org/bots/api#chat
 */
class ChatDTO
{
    public int $id;
    public string $type;
    public ?string $title;
    public ?string $username;
    public ?string $first_name;
    public ?string $last_name;
    public ?bool $is_forum;

    public function __construct(array $chat
    ) {
        $this->id = $chat['id'];
        $this->type = $chat['type'];
        $this->title = $chat['title'] ?? null;
        $this->username = $chat['username'] ?? null;
        $this->first_name = $chat['first_name'] ?? null;
        $this->last_name = $chat['last_name'] ?? null;
        $this->is_forum = $chat['is_forum'] ?? null;
    }
}