<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RestrictWebHookRequests
{
    /**
     * Allow Telegram Post requests to the webhook route only.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->path();
        $secretToken = config('services.telegram-bot-api.webhook_token');

        /** Valida se o token de aceeso para recebimento das mensagem Webhook está presente na url webhook,secret_token=<TOKEN-HERE>*/
        if (
            $request->isMethod('post')
            && $path === 'webhook'
            && $request->header('X-Telegram-Bot-Api-Secret-Token') === $secretToken
        ) {
            return $next($request);
        }

        return response()->json(['error' => 'Método não permitido'], 405);
    }
}
