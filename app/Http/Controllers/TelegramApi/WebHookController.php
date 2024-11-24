<?php

namespace App\Http\Controllers\TelegramApi;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TelegramApi\Types\UpdateDTO as Update;
use App\Http\Controllers\TelegramApi\Updates\HandleAnswerCallbackQueryController;
use App\Http\Controllers\TelegramApi\Updates\HandleUpdatesMessageController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebHookController extends Controller
{
    public function handle(Request $request): JsonResponse 
    {
        /**
         * Estratégia de tratamento os updates recebidos do Telegram
         * 
         * Passo  1: Identificação do tipo de update por meio da função match a seguir
         * Passo  2: Encaminhamento do update para a classe responsável, de acordo com o tipo
         * Passo  3: A classe responsável responsável irá tratar o update de acordo com o tipo de mensagem
         */

        $body = $request->json()->all();
        $update = new Update($body);
        
        //file_put_contents(storage_path('logs/laravel.log'), '');
        
        match(true) {
            // Faz o tratamento updates do tipo Message
            isset($update->message) => HandleUpdatesMessageController::index($update->message),
            // Faz o tratamento das mensagens editadas
            isset($update->edited_message) =>Log::info(json_encode($update?->edited_message?->text)),
            // Faz o tratamento das mensagens do tipo callback
            isset($update->callback_query) => HandleAnswerCallbackQueryController::index($update),
            
            // Existem diversos tipo de mensagem não exemplificados aqui.

            default => Log::info('Tipo de update não identificado', ['UPDATE'=> $update]),
        };
        
        return response()->json(['Response' => $update]);
    }

}
