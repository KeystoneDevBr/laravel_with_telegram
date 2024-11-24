<?php

namespace App\Filament\Widgets;

use App\Http\Controllers\TelegramApi\Types\TelegramMessageTypesExamples;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;


class TelegramMensagesWidgets extends BaseWidget
{

    //protected int | string | array $columnSpan = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('Enviar', 'Mensagem')
                ->description('Send Message')
                ->descriptionIcon('heroicon-m-chat-bubble-left-ellipsis')
                ->url('/admin/telegram/' . TelegramMessageTypesExamples::TEXT_NOFITICATION, false)
                ->color('info'),

            Stat::make('Compartilhar', 'Localização')
                ->description('Send Location')
                ->descriptionIcon('heroicon-s-map-pin')
                ->url('/admin/telegram/' . TelegramMessageTypesExamples::LOCATION, false)
                ->color('info'),

            Stat::make('Mensagem com', 'Opções')
                ->description('Send Options')
                ->descriptionIcon('heroicon-c-numbered-list')
                ->url('/admin/telegram/' . TelegramMessageTypesExamples::OPTIONS, false)
                ->color('info'),

            Stat::make('Compartilhar', 'Contato')
                ->description('Share Contact')
                ->descriptionIcon('heroicon-s-user-circle')
                ->url('/admin/telegram/' . TelegramMessageTypesExamples::CONTACT, false)
                ->color('info'),

            Stat::make('Enviar arquivo de', 'Áudio')
                ->description('Send Audio')
                ->descriptionIcon('heroicon-c-speaker-wave')
                ->url('/admin/telegram/' . TelegramMessageTypesExamples::AUDIO, false)
                ->color('info'),

            Stat::make('Enviar arquivo de', 'Imagem')
                ->description('Send Image')
                ->descriptionIcon('heroicon-s-photo')
                ->url('/admin/telegram/' . TelegramMessageTypesExamples::IMAGE, false)
                ->color('info'),

            Stat::make('Enviar Documento do tipo', 'PDF')
                ->description('Send file PDF')
                ->descriptionIcon('heroicon-o-document')
                ->url('/admin/telegram/' . TelegramMessageTypesExamples::PDF, false)
                ->color('info'),

            Stat::make('Enviar', 'Vídeo')
                ->description('Send video')
                ->descriptionIcon('heroicon-o-film')
                ->url('/admin/telegram/' . TelegramMessageTypesExamples::VIDEO, false)
                ->color('info'),

            Stat::make('Enviar', 'Gift')
                ->description('Send Gift Image')
                ->descriptionIcon('heroicon-s-photo')
                ->url('/admin/telegram/' . TelegramMessageTypesExamples::GIFT, false)
                ->color('info'),

            Stat::make('Enviar', 'View')
                ->description('Send View')
                ->descriptionIcon('heroicon-s-photo')
                ->url('/admin/telegram/' . TelegramMessageTypesExamples::VIEW, false)
                ->color('info'),

            Stat::make('Enviar Planilha', 'CSV')
                ->description('Send File')
                ->descriptionIcon('heroicon-s-photo')
                ->url('/admin/telegram/' . TelegramMessageTypesExamples::CSV, false)
                ->color('info'),

            Stat::make('Buscar última mensagem', 'getUpdates')
                ->description('Buscar Mensagem')
                ->descriptionIcon('heroicon-o-chat-bubble-bottom-center-text')
                ->url('/telegram/getUpdates/', true)
                ->color('info'),

            Stat::make('Busca Informações do Bot', 'getMe')
                ->description('Busca informações do Bot')
                ->descriptionIcon('heroicon-o-chat-bubble-bottom-center-text')
                ->url('/telegram/getMe/', true)
                ->color('info'),

            Stat::make('Buscar infor. do WebHook', 'getWebHookInfo')
                ->description('Buscar info. do WebHook')
                ->descriptionIcon('heroicon-o-chat-bubble-bottom-center-text')
                ->url('/telegram/getWebHookInfo/', true)
                ->color('info'),

            Stat::make('Apaga o último webhook', 'deleteWebhook')
                ->description('Apaga o WebHook')
                ->descriptionIcon('heroicon-o-chat-bubble-bottom-center-text')
                ->url('/telegram/deleteWebhook/', true)
                ->color('info'),

            Stat::make('Configura o WebHook', 'setWebHook')
                ->description('Configurar o webHook')
                ->descriptionIcon('heroicon-o-chat-bubble-bottom-center-text')
                ->url('/telegram/setWebHook', true)
                ->color('info')


        ];
    }
}
