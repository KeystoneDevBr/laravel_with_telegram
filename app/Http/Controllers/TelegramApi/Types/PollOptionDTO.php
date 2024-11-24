<?php

namespace App\Http\Controllers\TelegramApi\Types;

use App\Http\Controllers\TelegramApi\Types\MessageEntityDTO as MessageEntity;

class PollOptionDTO
{

    public string $text;
    public ?array $text_entities;
    public int $voter_count;
    public function __construct(array $pollOption)
    {
        $this->text = $pollOption['text'];
        $this->text_entities = isset($pollOption['text_entities']) ? array_map(
            fn($entity) => new MessageEntity($entity),
            $pollOption['text_entities']
        ) : null;
        $this->voter_count = $pollOption['voter_count'];
    }
}