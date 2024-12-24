<?php

namespace App\Providers;

use App\Services\AuditLogService;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            [self::class, 'logRegistration'],
        ],
        Login::class => [
            [self::class, 'logLogin'],
        ],
        Logout::class => [
            [self::class, 'logLogout'],
        ],
        Failed::class => [
            [self::class, 'logFailedLogin'],
        ],
    ];

    public static function logRegistration($event): void
    {
        app(AuditLogService::class)->log('registration', $event->user);
    }

    public static function logLogin($event): void
    {
        app(AuditLogService::class)->log('login', $event->user);
    }

    public static function logLogout($event): void
    {
        app(AuditLogService::class)->log('logout', $event->user);
    }

    public static function logFailedLogin($event): void
    {
        app(AuditLogService::class)->log('failed_login', null, ['email' => $event->credentials['email']]);
    }

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
