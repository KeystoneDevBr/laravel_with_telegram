<?php

namespace App\Http\Controllers\TelegramApi\Types;


class CopyTextButtonDTO
{
    public $text;
    public function __construct($text)
    {
        $this->text = $text;
    }
    public function isValid()
    {
        return isset($this->text) && is_string($this->text) && strlen($this->text) >= 1 && strlen($this->text) <= 256;
    }
}
