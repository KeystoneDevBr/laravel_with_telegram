<?php

namespace App\Http\Controllers\TelegramApi\Types;

/**
 *  This object represents one size of a photo or a file / sticker thumbnail.
 * saiba mais em https://core.telegram.org/bots/api#photosize
 */
class PhotoSizeDTO
{
    public string $file_id;
    public string $file_unique_id;
    public int $width;
    public int $height;
    public ?int $file_size;

    public function __construct(array $photoSize)
    {
        $this->file_id = $photoSize['file_id'];
        $this->file_unique_id = $photoSize['file_unique_id'];
        $this->width = $photoSize['width'];
        $this->height = $photoSize['height'];
        $this->file_size = $photoSize['file_size'] ?? null;
    }
}