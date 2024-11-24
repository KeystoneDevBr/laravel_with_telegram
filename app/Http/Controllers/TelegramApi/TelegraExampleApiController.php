<?php

namespace App\Http\Controllers\TelegramApi;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TelegramApi\Types\TelegramMessageTypesExamples;
use App\Notifications\TelegramNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Integrations\TelegramApi\Requests\DeleteWebHookRequest;
use App\Integrations\TelegramApi\Requests\GetMeRequest;
use App\Integrations\TelegramApi\Requests\GetUpdatesRequest;
use App\Integrations\TelegramApi\Requests\GetWebHookInfoRequest;
use App\Integrations\TelegramApi\Requests\SetWebHookRequest;
use Illuminate\Http\JsonResponse;

class TelegraExampleApiController extends Controller
{
    public function sendTelegramNotification(string $messageType, Request $request)
    {
        Notification::route('telegram', config('services.telegram-bot-api.user_id'))
            ->notify(new TelegramNotification(
                TelegramMessageTypesExamples::selectMessageType($messageType)
            ));
        \Filament\Notifications\Notification::make()
            ->title('Mensagem Enviada!')
            ->success()
            ->body('Confira no Telegram.')
            ->send();

        return  redirect($request->root() . '/admin/');
    }

    public function getUpdates()
    {
        $getUpdatesResponse = (new GetUpdatesRequest())->send();


        $status = $getUpdatesResponse->status();
        $updates = $getUpdatesResponse->dto()->getMessagesFromResponse();
        if ($status  == 200 && count($updates) > 0) {
            return response()->json(
                $getUpdatesResponse
                    ->dto()
                    ->getLastMessageFromResponse()
                    ?->text
            );
        }

        return response()->json([
            'Response' => $getUpdatesResponse->json()
        ]);
    }

    public function getMe()
    {
        $getMeResponse = (new GetMeRequest())->send();

        if ($getMeResponse->status() == 200) {
            return response()->json(
                $getMeResponse
                    ->json()
            );
        }

        return response()->json([
            'error' => $getMeResponse->json()
        ]);
    }

    public function getWebHookInfo(): JsonResponse
    {
        $getWebHookInfoResponse = (new GetWebHookInfoRequest())->send();

        if ($getWebHookInfoResponse->status() == 200) {
            return response()->json(
                $getWebHookInfoResponse
                    ->json()
            );
        }

        return response()->json([
            'error' => $getWebHookInfoResponse->json()
        ]);
    }

    public function deleteWebhook(): JsonResponse
    {
        $deleteWebHookResponse = (new DeleteWebHookRequest())->send();

        if ($deleteWebHookResponse->status() == 200) {
            return response()->json(
                $deleteWebHookResponse
                    ->json()
            );
        }

        return response()->json([
            'error' => $deleteWebHookResponse->json()
        ]);
    }

    public function setWebHook(): JsonResponse
    {

        $setWebHookResponse = (new SetWebHookRequest())->send();

        if ($setWebHookResponse->status() == 200) {
            return response()->json(
                $setWebHookResponse
                    ->json()
            );
        }

        return response()->json([
            'error' => $setWebHookResponse->json()
        ]);
    }
}
