<?php
namespace App\Http\Controllers\TelegramApi\Types;

/**
 * Classe SwitchInlineQueryChosenChatDTO
 * 
 * Classe responsável por armazenar os dados de um objeto SwitchInlineQueryChosenChatDTO.
 */
class SwitchInlineQueryChosenChatDTO
{

    public ?string $query;
    public ?bool $allow_user_chats;
    public ?bool $allow_bot_chats;
    public ?bool $allow_group_chats;
    public ?bool $allow_channel_chats;
    
    public function __construct(array $data)
    {
        $this->query = $data['query'];
        $this->allow_user_chats = $data['allow_user_chats'];
        $this->allow_bot_chats = $data['allow_bot_chats'];
        $this->allow_group_chats = $data['allow_group_chats'];
        $this->allow_channel_chats = $data['allow_channel_chats'];
    }
}
