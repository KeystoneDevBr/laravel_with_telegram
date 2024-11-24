<?php


namespace App\Http\Controllers\TelegramApi\Types;

use NotificationChannels\Telegram\TelegramBase;
use NotificationChannels\Telegram\TelegramFile;
use NotificationChannels\Telegram\TelegramLocation;
use NotificationChannels\Telegram\TelegramMessage;
use NotificationChannels\Telegram\TelegramPoll;
use NotificationChannels\Telegram\TelegramContact;

class TelegramMessageTypesExamples
{
    public const TEXT_NOFITICATION = 'textNotification';
    public const LOCATION = 'geolocation';
    public const OPTIONS = 'options';
    public const CONTACT = 'contact';
    public const AUDIO = 'audio';
    public const IMAGE = 'image';
    public const PDF = 'pdf';
    public const VIDEO = 'video';
    public const GIFT = 'gift';
    public const VIEW = 'view';
    public const CSV = 'csv';
    public const WEBHOOKRESPONSE = 'webhookResponse';

    public static function  selectMessageType(string $messageType): TelegramBase
    {
        return match ($messageType) {
            self::TEXT_NOFITICATION => self::getTextMessage(),
            self::LOCATION => self::getLocationMessage(),
            self::OPTIONS => self::getOptionsMessage(),
            self::CONTACT => self::getContactMessage(),
            self::AUDIO => self::getAudioMessage(),
            self::IMAGE => self::getImageMessage(),
            self::PDF => self::getPdfFileMessage(),
            self::VIDEO => self::getVideoFileMessage(),
            self::GIFT => self::getImageGiftMessage(),
            self::VIEW => self::getViewMessage(),
            self::CSV => self::getCSVFileMessage(),
            self::WEBHOOKRESPONSE => self::getWebhookResponseMessage(),
            default => TelegramMessage::create()->content('Nenhuma mensagem definida'),
        };
    }

    protected static function getTextMessage(): TelegramBase
    {
        $urlDocumen = 'https://laravel-notification-channels.com/telegram/';
        $urlTutorial = 'https://www.zabbix.com/br/integrations/telegram';

        return TelegramMessage::create()
            ->line("Olá, tudo bem!")
            ->line("Você está recebendo essa mensagem via Laravel")
            ->line("Selecione uma das opções!")

            // (Optional) Blade template for the content.
            // ->view('notification', ['url' => $url])

            // (Optional) Inline Buttons
            ->button('Documentação', $urlDocumen)
            ->button('Tutorial Bot', $urlTutorial)
            // (Optional) Inline Button with callback. You can handle callback in your bot instance
            ->buttonWithCallback('Opção 1', 'opcao1')
            ->buttonWithCallback('Opção 2', 'opcao2');
    }

    protected static function getLocationMessage(): TelegramBase
    {
        return TelegramLocation::create()
            ->latitude(-13.321965)
            ->longitude(-46.571505);
    }

    protected static function getOptionsMessage(): TelegramBase
    {
        return TelegramPoll::create()
            ->question('Escolha uma opção:')
            ->choices([
                'Opção 1',
                'Opção 2',
                'Opção 3',
            ]);
    }

    protected static function getContactMessage(): TelegramBase
    {
        return TelegramContact::create()
            ->phoneNumber('+5511999999999')
            ->firstName('Fulano')
            ->lastName('de Tal');
    }

    public static function getAudioMessage(): TelegramBase
    {
        return TelegramFile::create()
            ->content('Audio')
            ->audio('https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3');
    }

    protected static function getImageMessage(): TelegramFile
    {
        return TelegramFile::create()
            ->content('Essa pessoa não *existe* [Link URL](https://thispersondoesnotexist.com)')
            ->photo('https://thispersondoesnotexist.com');
    }

    protected static function getImageGiftMessage(): TelegramBase
    {
        return TelegramFile::create()
            ->content('Legal, podemos enviar imagens *gift* [inline URL](https://sample-videos.com/gif/2.gif)')
            ->photo('https://sample-videos.com/gif/2.gif');
    }

    protected static function getPdfFileMessage(): TelegramBase
    {
        return TelegramFile::create()
            ->content('Aquivo PDF')
            ->document('https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf');
    }

    protected static function getVideoFileMessage(): TelegramBase
    {
        return TelegramFile::create()
            ->content('Aquivo de Vídeo')
            ->video('https://www.sample-videos.com/video123/mp4/720/big_buck_bunny_720p_1mb.mp4');
    }

    protected static function getViewMessage(): TelegramMessage
    {
        return TelegramMessage::create()
            ->view('telegram-message', ['link' => 'https://laravel-notification-channels.com/telegram/']);
    }

    protected static function getCSVFileMessage(): TelegramBase
    {
        return TelegramFile::create()
            ->content('Aquivo CSV')
            ->document(base_path('/public/sample.csv'));
    }

    protected static function getWebhookResponseMessage(): TelegramBase
    {
        $urlDocumen = 'https://core.telegram.org/bots/api#getting-updates';
        $urlTutorial = 'https://github.com/KeystoneDevBr';

        return TelegramMessage::create()
            ->content("Olá, tudo bem!")
            ->line("\nEssa é uma mensagem de resposta automática para o webhook")

            ->button('Documentação', $urlDocumen)
            ->button('Meu GitHub', $urlTutorial);
    }
}
