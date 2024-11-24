<?php

namespace App\Http\Controllers\TelegramApi\Updates;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TelegramApi\Types\CallbackQueryDTO as CallbackQuery;
use App\Http\Controllers\TelegramApi\Types\InlineKeyboardButton;
use App\Http\Controllers\TelegramApi\Types\InlineKeyboardMarkup;
use App\Http\Controllers\TelegramApi\Types\MessageDTO as Message;
use App\Http\Controllers\TelegramApi\Types\TelegramMessageTypesExamples;
use App\Integrations\TelegramApi\Requests\AnswerCallbackQueryRequest;
use App\Integrations\TelegramApi\Requests\EditMessageTextRequest;
use App\Integrations\TelegramApi\Requests\SendMessageRequest;
use App\Notifications\TelegramNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;
use Error;

class HandleInlineKeyboardController extends Controller
{

    const OPTION1 = 'bR3bH';
    const OPTION2 = 'Xw2OP';
    const OPTION3 = 'Qp0Qn';
    const OPTION4 = 'kO24N';
    const OPTION5 = '9lNBD';
    const OPTION6 = 'dk58f';
    const OPTION7 = '5d9gd';
    const OPTION99 = '39gj2';

    /**
     * Cria o menu de opções do tipo Inlinekeyboard como resposta do comando /start
     * 
     * @param \App\Http\Controllers\TelegramApi\Types\MessageDTO $message
     * @param mixed $callbackData
     * @return void
     */
    public static function index(Message $message, ?string $callbackData = null): void
    {
        try {
            //Pode Ser colocado em um job para evitar mútiplas requisições.
            $request = self::prepareSendMessageRequest($message, $callbackData);
            $response = $request->send();
        } catch (Error $e) {
            Log::error('Erro ao disparar a mensagem inicial em HandleInlineKeyboardController::index() ');
        }
    }

    public static function answerCallback(CallbackQuery $callbackQuery)
    {

        try {
            // Atualiza as opções do menu em linha (Inlinekeyboard)
            $newMessage = self::prepareUpdateMessage($callbackQuery);
            $responseMessage = $newMessage->send();

            // Envia feedback ao usuários
            $answer = new AnswerCallbackQueryRequest(
                calback_query_id: $callbackQuery->id,
                text: 'Ação concluída com sucesso!',
                show_alert: false,
            );;

            $callbackResponse = HandleAnswerCallbackQueryController::sendAnswer($answer);
        } catch (Error $e) {
            Log::error('Erro em HandleInlineKeyboardController::answerCallback()');
        }
    }

    /**
     * Conjunto de botões para mostrar no menu do opções do tipo Inlinekeyboard
     * 
     * @param mixed $select
     * @return \App\Http\Controllers\TelegramApi\Types\InlineKeyboardMarkup
     */
    protected static function getInlineKeyboard(?string $select = null): InlineKeyboardMarkup
    {
        $button1 = new InlineKeyboardButton(text: 'Mostrar opções', callback_data: self::OPTION1);
        $button2 = new InlineKeyboardButton(text: '+ Opções', callback_data: self::OPTION2);
        $button3 = new InlineKeyboardButton(text: 'Baixar Imagen', callback_data: self::OPTION3);
        $button4 = new InlineKeyboardButton(text: 'Baixar Planilha', callback_data: self::OPTION4);
        $button5 = new InlineKeyboardButton(text: 'Baixar PDF', callback_data: self::OPTION5);
        $button6 = new InlineKeyboardButton(text: '<< Voltar para Menu Principal', callback_data: self::OPTION6);
        $button7 = new InlineKeyboardButton(text: '<< Voltar', callback_data: self::OPTION7);
        $button99 = new InlineKeyboardButton(text: '<< Voltar', callback_data: self::OPTION99);

        return match (true) {
            $select == self::OPTION1 => new InlineKeyboardMarkup([[$button2, $button3], [$button6]]),
            $select == self::OPTION2 => new InlineKeyboardMarkup([[$button4], [$button5], [$button7]]),
            $select == self::OPTION3 => self::handleOption3(),
            $select == self::OPTION4 => self::handleOption4(),
            $select == self::OPTION5 => self::handleOption5(),
            $select == self::OPTION6 => new InlineKeyboardMarkup([[$button1]]),
            $select == self::OPTION7 => new InlineKeyboardMarkup([[$button2, $button3], [$button6]]),
            $select == self::OPTION99 => new InlineKeyboardMarkup([[], []]),
                // Default Options
            default => new InlineKeyboardMarkup([[$button1]]),
        };
    }

    /**
     * Sumário do conjunto de botões selecionados
     * @param mixed $select
     * @return string
     */
    protected static function getTextOptions(?string $select = null): string
    {
        return match (true) {
            $select == self::OPTION1 => 'Demonstrando as demais opções',
            $select == self::OPTION2 => 'Opção 2 selecionada! Novas opções disponíveis:',
            $select == self::OPTION3 => 'Opção 3 selecionada! Novas opções disponíveis:',
            $select == self::OPTION4 => 'Opção 4 selecionada!',
            $select == self::OPTION5 => 'Opção 5 selecionada!',
            $select == self::OPTION6 => 'Bem vindo ao menu principal!',
            $select == self::OPTION7 => 'Novas opções disponíveis:',
            $select == self::OPTION99 => 'Opção 99 selecionada!',
                //$select == self::OPTION6 => 'Voltando ao menu principal',
            default => 'Bem vindo ao menu principal!'
        };
    }


    /**
     * Prepara a mensagem inicial (Menu de opções do tipo Inlinekeyboard)
     * 
     * @param \App\Http\Controllers\TelegramApi\Types\MessageDTO $message
     * @param mixed $callbackData
     * @return \App\Integrations\TelegramApi\Requests\SendMessageRequest
     */
    protected static function prepareSendMessageRequest(Message $message, ?string $callbackData = null): sendMessageRequest
    {

        return new SendMessageRequest(
            chatId: $message->from->id,
            text: self::getTextOptions($callbackData),
            disableNotification: false,
            replyMarkup: self::getInlineKeyboard($callbackData)
        );
    }

    /**
     * Prepara a atualização do menu de opções do tipo Inlinekeyboard, de acordo com a opção selecionada via bot
     * 
     * @param mixed $callbackQuery
     * @return \App\Integrations\TelegramApi\Requests\EditMessageTextRequest
     */
    protected static function prepareUpdateMessage(?CallbackQuery $callbackQuery): EditMessageTextRequest
    {
        $options = self::getInlineKeyboard($callbackQuery->data);
        
        return new EditMessageTextRequest(
            text: self::getTextOptions($callbackQuery->data),
            chatId: $callbackQuery->from->id,
            messageId: $callbackQuery->message->message->message_id,
            replyMarkup: $options
        );
    }

    protected static function handleOption3()
    {
        Notification::route('telegram', config('services.telegram-bot-api.user_id'))
            ->notify(new TelegramNotification(
                TelegramMessageTypesExamples::selectMessageType(
                    TelegramMessageTypesExamples::IMAGE
                )
            ));
    }


    protected static function handleOption4()
    {
        Notification::route('telegram', config('services.telegram-bot-api.user_id'))
            ->notify(new TelegramNotification(
                TelegramMessageTypesExamples::selectMessageType(
                    TelegramMessageTypesExamples::CSV
                )
            ));
    }


    protected static function handleOption5()
    {
        Notification::route('telegram', config('services.telegram-bot-api.user_id'))
            ->notify(new TelegramNotification(
                TelegramMessageTypesExamples::selectMessageType(
                    TelegramMessageTypesExamples::PDF
                )
            ));
    }
}
