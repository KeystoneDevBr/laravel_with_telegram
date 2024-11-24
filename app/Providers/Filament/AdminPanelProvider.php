<?php

namespace App\Providers\Filament;

use App\Filament\Resources\UserResource\Pages\Auth\RequestPasswordReset;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\ButtonAction;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->profile()
            //->passwordReset() ->authGuard('web')
            ->passwordReset(RequestPasswordReset::class)
            ->colors([
                'primary' => Color::Amber,
            ])
            //->maxContentWidth(MaxWidth::Full)
            ->brandName('Nome da Marca')
            // ->brandLogo(asset('images/logo.svg'))
            // ->brandLogoHeight('3rem')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Configurações'),
                //->collapsible(false)
                //->icon('heroicon-m-cog-6-tooth'),
                NavigationGroup::make()
                    ->label('Telegram')
                    ->icon('heroicon-s-paper-airplane')
            ])
            ->userMenuItems([
                'logout' => MenuItem::make()->label('Sair'),
            ])
            ->navigationItems([
                NavigationItem::make('Nav. Item 1')
                    //->hidden(fn() => Auth::check())
                    ->group('Configurações')
                    ->url('/#', shouldOpenInNewTab: false)
                    ->icon('heroicon-o-home')
                    ->sort(1),
                NavigationItem::make('Documentação')
                    ->group('Telegram')
                    ->url('https://laravel-notification-channels.com/telegram/', shouldOpenInNewTab: true)
                    ->sort(2),
                NavigationItem::make('Documentação da API')
                    ->group('Telegram')
                    ->url('https://core.telegram.org/bots/api', shouldOpenInNewTab: true)
                    ->sort(3),
                NavigationItem::make('Criação do Bot')
                    ->group('Telegram')
                    ->url('https://www.zabbix.com/br/integrations/telegram', shouldOpenInNewTab: true)
                    ->sort(4)
            ])
            //->sidebarFullyCollapsibleOnDesktop(); //hiddens sidebar and icons
            //->sidebarCollapsibleOnDesktop();
            ->topNavigation();
    }
}
