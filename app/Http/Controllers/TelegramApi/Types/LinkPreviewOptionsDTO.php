<?php

namespace App\Http\Controllers\TelegramApi\Types;

/**
 * This object represents the options used for link preview generation.
 * Saiba mais em: https://core.telegram.org/bots/api#linkpreviewoptions
 */
class LinkPreviewOptionsDTO
{
    public bool $is_disabled = true;
    public ?string $url;
    public bool $prefer_small_media;
    public bool $prefer_large_media = false;
    public bool $show_above_text = false;

    public function __construct(array $options)
    {
        $this->is_disabled = $options['is_disabled'] ?? true;
        $this->url = $options['url'] ?? null;
        $this->prefer_small_media = $options['prefer_small_media'] ?? false;
        $this->prefer_large_media = $options['prefer_large_media'] ?? false;
        $this->show_above_text = $options['show_above_text'] ?? false;
    }
}
