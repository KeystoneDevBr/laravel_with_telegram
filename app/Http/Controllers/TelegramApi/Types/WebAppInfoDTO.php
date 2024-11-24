<?php

namespace App\Http\Controllers\TelegramApi\Types;

class WebAppInfoDTO
{
    /**
     * @var string URL do Web App (deve ser um HTTPS válido)
     */
    private string $url;

    public function __construct(string $url)
    {
        $this->setUrl($url);
    }

    /**
     * Obtém a URL do Web App.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Define a URL do Web App (verifica se é HTTPS).
     *
     * @param string $url
     * @throws \InvalidArgumentException
     */
    public function setUrl(string $url): void
    {
        // Validação para garantir que a URL seja válida e use HTTPS.
        if (!filter_var($url, FILTER_VALIDATE_URL) || parse_url($url, PHP_URL_SCHEME) !== 'https') {
            throw new \InvalidArgumentException('A URL deve ser um endereço válido com HTTPS.');
        }
        
        $this->url = $url;
    }
}
