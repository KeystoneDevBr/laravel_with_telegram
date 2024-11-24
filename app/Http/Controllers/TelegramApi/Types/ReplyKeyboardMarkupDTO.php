<?php

namespace App\Http\Controllers\TelegramApi\Types;

use App\Http\Controllers\TelegramApi\Types\KeyboardButtonDTO as KeyboardButton;

/**
 * This object represents a custom keyboard with reply options.
 * Saiba mais em: (link para a documentação correspondente, se disponível)
 */
class ReplyKeyboardMarkupDTO
{
    /**
     * @var KeyboardButton[][]
     */


    public function __construct(
        public array $keyboard,
        public ?bool $is_persistent = false,
        public ?bool $resize_keyboard = false,
        public ?bool $one_time_keyboard = false,
        public ?string $input_field_placeholder = '',
        public ?bool $selective = false
    ) {}
}
