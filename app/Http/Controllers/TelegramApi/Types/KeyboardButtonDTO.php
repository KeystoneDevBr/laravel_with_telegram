<?php

namespace App\Http\Controllers\TelegramApi\Types;

class KeyboardButtonDTO
{
    public string $text;
    //public ?KeyboardButtonRequestUsers $request_users;
    //public ?KeyboardButtonRequestChat $request_chat;
    public bool $request_contact = false;
    public bool $request_location = false;
    //public ?KeyboardButtonPollType $request_poll;
    //public ?WebAppInfo $web_app;

    public function __construct(
        string $text,
        //?KeyboardButtonRequestUsers $request_users = null,
        //?KeyboardButtonRequestChat $request_chat = null,
        //?bool $request_contact = null,
        bool $request_location = false,
        //?KeyboardButtonPollType $request_poll = null,
        //?WebAppInfo $web_app = null
    ) {
        $this->text = $text;
        //$this->request_users = $request_users;
        //$this->request_chat = $request_chat;
        //$this->request_contact = $request_contact;
        //$this->request_location = $request_location;
        //$this->request_poll = $request_poll;
        //$this->web_app = $web_app;
    }
}
