<?php

namespace App\Http\Controllers\TelegramApi\Updates;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TelegramApi\Types\UpdateDTO as Update;
use App\Integrations\TelegramApi\Requests\AnswerCallbackQueryRequest;
use Error;
use Illuminate\Support\Facades\Log;
use Saloon\Http\Response;

/**
 * 
 * Classe responsável por lidar com as respostas às requisições passada via callbackQuery
 */
class HandleAnswerCallbackQueryController extends Controller
{

    /**
     * Determina o tipo de callback recebida via webHook e encaminha a ação 
     * para classe responsável
     * 
     * @param \App\Http\Controllers\TelegramApi\Types\UpdateDTO $update
     * @return void
     */
    public static function index(Update $update){
        
        $callbackData = $update->callback_query?->data ?? null;

        $isInlineKeyboardButton = $callbackData == (
            HandleInlineKeyboardController::OPTION1 || 
            HandleInlineKeyboardController::OPTION2 || 
            HandleInlineKeyboardController::OPTION3 ||
            HandleInlineKeyboardController::OPTION4 ||
            HandleInlineKeyboardController::OPTION5 ||
            HandleInlineKeyboardController::OPTION6
        );

        $isOtherKindOfButton = true;

        match(true){
            // Classe responável por lidar com as resposta do menu inicial (/start)
            $isInlineKeyboardButton => HandleInlineKeyboardController::answerCallback($update->callback_query),
            // Definir aqui ações para outros tipos de botões;
            // Diversos tipos de botões com calback podem ser criados;
            // $isOtherKindOfButton => Log::info('Exemplo de outro tipo de botão'),
            default => Log::info('Campo data não informado',[$callbackData]),
        };
    }

    /**
     * Lida com o envio da resposta ao callbackQuery
     * Recebe um objeto do tipo AnswerCallbackQueryRequest e envia a resposta
     * @param \App\Integrations\TelegramApi\Requests\AnswerCallbackQueryRequest $answerCallbackQueryRequest
     * @return void
     */
    public static function sendAnswer(AnswerCallbackQueryRequest $answerCallbackQueryRequest): Response{
        try {
            $response = $answerCallbackQueryRequest->send();
        } catch (Error $e) {
            Log::error('Erro ao enviar resposta ao callbackQuery');
        }
        return $response;
    }
}
