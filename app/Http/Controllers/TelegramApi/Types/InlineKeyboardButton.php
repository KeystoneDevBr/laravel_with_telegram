<?php
namespace App\Http\Controllers\TelegramApi\Types;

use App\Http\Controllers\TelegramApi\Types\WebAppInfoDTO as WebAppInfo;
use App\Http\Controllers\TelegramApi\Types\SwitchInlineQueryChosenChatDTO as SwitchInlineQueryChosenChat;
use App\Http\Controllers\TelegramApi\Types\CopyTextButtonDTO as CopyTextButton;

/**
 * This object represents one button of an inline keyboard. Exactly one of the optional fields must be used to specify type of the button.
 * See more: https://core.telegram.org/bots/api#inlinekeyboardbutton
 */
class InlineKeyboardButton
{

    public function __construct(
        public string $text,
        public string $url = '',
        public ?string $callback_data = null,
        public ?WebAppInfo $web_app = null,
        public ?string $login_url = null, //Ajustar Tipo
        public ?string $switch_inline_query = null,
        public ?string $switch_inline_query_current_chat = null,
        public ?SwitchInlineQueryChosenChat $switch_inline_query_chosen_chat = null,
        public ?CopyTextButton $copy_text = null,
        public ?string $callback_game = null, // Ajustar tipo
        public ?bool $pay = false,
    ){
        //
    }

}
     
