<?php

namespace App\Http\Controllers\TelegramApi\Types;

use App\Http\Controllers\TelegramApi\Types\InlineKeyboardButton;

class InlineKeyboardMarkup
{
    /**
     * Array of Array
     * @param InlineKeyboardButton[]
     */
    public array $inline_keyboard;
    public function __construct(array $inlineKeyboardButton)
    {
        $this->inline_keyboard = $inlineKeyboardButton;
    }
}
