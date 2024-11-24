<?php

use App\Http\Controllers\TelegramApi\TelegraExampleApiController;
use App\Http\Controllers\TelegramApi\WebHookController;
use App\Http\Middleware\RestrictWebHookRequests;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Support\Facades\Route;


/** Public Routes */
Route::redirect('/', '/admin');
Route::get('/admin/telegram/{typeMessage}', [TelegraExampleApiController::class, 'sendTelegramNotification']);
Route::get('/telegram/getUpdates', [TelegraExampleApiController::class, 'getUpdates']);
Route::get('/telegram/getWebHookInfo', [TelegraExampleApiController::class, 'getWebHookInfo']);
Route::get('/telegram/getMe', [TelegraExampleApiController::class, 'getMe']);
Route::get('/telegram/deleteWebhook', [TelegraExampleApiController::class, 'deleteWebhook']);
Route::get('/telegram/setWebHook', [TelegraExampleApiController::class, 'setWebHook']);

/**
 * Telegram Webhook
 * Permite de maneira segura o recebimento de mensagens do Telegram via Webhook.
 * Para isso o Middleware RestrictWebHookRequests é utilizado para restringir o acesso ao endpoint de Webhook, no lugar do ValidateCsrfToken.
 * O parâmetro secret_token deverá estar presente nas mensagens recebidas.
 */
Route::middleware([RestrictWebHookRequests::class])->group(function () {
    Route::post('/webhook', [WebHookController::class, 'handle'])
        ->withoutMiddleware([ValidateCsrfToken::class]);
});
