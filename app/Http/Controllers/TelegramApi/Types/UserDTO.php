<?php

namespace App\Http\Controllers\TelegramApi\Types;

/**
 * This object represents a Telegram user or bot.
 * Saiba mais em: https://core.telegram.org/bots/api#user
 */
class UserDTO
{
    public int $id;
    public bool $is_bot;
    public string $first_name;
    public ?string $last_name;
    public ?string $username;
    public ?string $language_code;
    public ?bool $is_premium;
    public ?bool $added_to_attachment_menu;
    public ?bool $can_join_groups;
    public ?bool $can_read_all_group_messages;
    public ?bool $supports_inline_queries;
    public ?bool $can_connect_to_business;
    public ?bool $has_main_web_app;

    public function __construct(array $user
    ) {
        $this->id = $user['id'];
        $this->is_bot = $user['is_bot'];
        $this->first_name = $user['first_name'];
        $this->last_name = $user['last_name'] ?? null;
        $this->username = $user['username'] ?? null;
        $this->language_code = $user['language_code'] ?? null;
        $this->is_premium = $user['is_premium'] ?? null;
        $this->added_to_attachment_menu = $user['added_to_attachment_menu'] ?? null;
        $this->can_join_groups = $user['can_join_groups'] ?? null;
        $this->can_read_all_group_messages = $user['can_read_all_group_messages'] ?? null;
        $this->supports_inline_queries = $user['supports_inline_queries'] ?? null;
        $this->can_connect_to_business = $user['can_connect_to_business'] ?? null;
        $this->has_main_web_app = $user['has_main_web_app'] ?? null;
    }
}