<?php

namespace App\Integrations\TelegramApi\ResponseTypes;

use App\Http\Controllers\TelegramApi\Types\MessageDTO as Message;

/**
 * Define a Data Transfer Objet to handle the response from the GetUpdatesRequest
 * 
 */
class GetUpdatesResponseDTO
{
    public function __construct(
        public readonly bool $ok,
        public readonly ?int $error_code,
        public readonly ?string $description,
        public readonly ?array $results
    ) {}

    public function hasError()
    {
        return $this->ok === false;
    }

    public function getErrorCode()
    {
        return $this->error_code;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getResult()
    {
        return $this->results;
    }

    /**
     * Return an array of all messages form the response
     * @return Message[]
     */
    public function getMessagesFromResponse(): array
    {
        $messages = [];
        

        if (isset($this->results) && is_array($this->results)) {
            foreach ($this->results as $update) {
                if (isset($update['message'])) {
                    $messages[] = new Message( $update['message']);
                }
            }
        }
        return $messages;
    }

    /**
     * Return the last message from the response
     * @return Message
     */
  
    public function getLastMessageFromResponse(): array | Message
    {
        $messages = $this->getMessagesFromResponse();
        if(!empty($messages)) {
            return end($messages);
        }
        return [];
    }


}