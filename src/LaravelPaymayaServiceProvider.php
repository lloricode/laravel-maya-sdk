<?php

declare(strict_types=1);

namespace Lloricode\LaravelPaymaya;

use Lloricode\LaravelPaymaya\Commands\Customization\RemoveCustomizationCommand;
use Lloricode\LaravelPaymaya\Commands\Customization\RetrieveCustomizationCommand;
use Lloricode\LaravelPaymaya\Commands\Customization\SetCustomizationCommand;
use Lloricode\LaravelPaymaya\Commands\Webhook\CreateWebHookCommand;
use Lloricode\LaravelPaymaya\Commands\Webhook\GetAllWebhookCommand;
use Lloricode\Paymaya\Enums\Environment;
use Lloricode\Paymaya\Paymaya;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelPaymayaServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-maya-sdk')
            ->hasConfigFile()
            ->hasCommands(
                [
                    GetAllWebhookCommand::class,
                    CreateWebHookCommand::class,
                    SetCustomizationCommand::class,
                    RetrieveCustomizationCommand::class,
                    RemoveCustomizationCommand::class,
                ]
            );
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(
            Paymaya::class,
            fn () => new Paymaya(
                environment: Environment::from(config()->string('maya-sdk.mode')),
                secretKey: config()->string('maya-sdk.keys.secret'),
                publicKey: config()->string('maya-sdk.keys.public'),
            )
        );
    }
}
