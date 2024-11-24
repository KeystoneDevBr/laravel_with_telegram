<?php


namespace App\Http\Controllers\TelegramApi\Updates;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TelegramApi\Types\MessageDTO as Message;
use App\Http\Controllers\TelegramApi\Types\TelegramMessageTypesExamples;
use App\Http\Controllers\TelegramApi\Types\UpdateDTO as Update;
use App\Notifications\TelegramNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class HandleUpdatesMessageController extends Controller
{

    /**
     * Summary of index
     * @param \App\Http\Controllers\TelegramApi\Types\MessageDTO $message
     * @return void
     */
    public static function index(Message $message)
    {
        $chatId = $message->chat->id;
        $text = $message?->text;

        // Verifica se a mensagem é um comando de bot (pode existir mais de uma entitidade)
        if (isset($message->entities) && isset($message->entities[0]->type) && $message->entities[0]->type === 'bot_command') {
            match ($text) {
                '/start' => self::handleStartCommand($message),

                '/help' =>  self::handleHelpCommand($chatId),

                '/settings' => self::handleSettingsCommand($chatId),

                '/img' =>  Notification::route(TelegramChannel::class, $chatId)
                    ->notify(
                        new TelegramNotification(
                            TelegramMessageTypesExamples::selectMessageType(
                                TelegramMessageTypesExamples::IMAGE
                            )
                        )
                    ),

                '/pdf' =>  Notification::route(TelegramChannel::class, $chatId)
                    ->notify(
                        new TelegramNotification(
                            TelegramMessageTypesExamples::selectMessageType(
                                TelegramMessageTypesExamples::PDF
                            )
                        )
                    ),

                '/csv' =>  Notification::route(TelegramChannel::class, $chatId)
                    ->notify(
                        new TelegramNotification(
                            TelegramMessageTypesExamples::selectMessageType(
                                TelegramMessageTypesExamples::CSV
                            )
                        )
                    ),


                default => self::handleUndefinedCommand($chatId),
            };
        } else {
            match ($text) {
                'Olá', 'oi', 'Oi', 'Olá', 'Ola', 'ola', 'Oi!', 'oi!', 'Olá!', 'olá!', 'Ola!', 'ola!' =>
                Notification::route('telegram', $chatId)
                    ->notify(new TelegramNotification(
                        TelegramMessage::create()
                            ->line('Olá, como posso te ajudar?')
                    )),

                default => self::hanleNotBotCommand($chatId),
            };
        }
    }

    private static function handleStartCommand(Message $message)
    {
        // Show the Inline keyboard Options
        HandleInlineKeyboardController::index($message);
        // Outras ações podem ser criadas aqui.
    }

    private static function handleUndefinedCommand($chatId)
    {
        Notification::route('telegram', $chatId)
            ->notify(new TelegramNotification(
                TelegramMessage::create()
                    ->line('Comando não identificado!')
            ));
    }

    private static function hanleNotBotCommand($chatId)
    {
        Notification::route('telegram', $chatId)
            ->notify(new TelegramNotification(
                TelegramMessage::create()
                    ->line('Não conseguir entender o que você quis dizer!')
                    ->line('Por favor, utilize as opções do menu')
            ));
    }

    private static function handleHelpCommand($chatId)
    {
        Notification::route('telegram', $chatId)
            ->notify(new TelegramNotification(
                TelegramMessage::create()
                    ->line('Comando de ajuda!')
            ));
    }

    private static function handleSettingsCommand($chatId)
    {
        Notification::route('telegram', $chatId)
            ->notify(new TelegramNotification(
                TelegramMessage::create()
                    ->line('Configurações')
            ));
    }
}
