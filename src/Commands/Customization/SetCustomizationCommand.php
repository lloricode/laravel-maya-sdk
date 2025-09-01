<?php

declare(strict_types=1);

namespace Lloricode\LaravelPaymaya\Commands\Customization;

use Illuminate\Console\Command;
use Lloricode\LaravelPaymaya\Facades\PaymayaFacade;
use Lloricode\Paymaya\DataTransferObjects\Checkout\Customization\CustomizationDto;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'maya:customization:set', description: 'Set customization')]
class SetCustomizationCommand extends Command
{
    public function handle(): int
    {
        PaymayaFacade::createCustomization(
            new CustomizationDto(
                logoUrl: config()->string('maya-sdk.checkout.customization.logoUrl'),
                iconUrl: config()->string('maya-sdk.checkout.customization.iconUrl'),
                appleTouchIconUrl: config()->string('maya-sdk.checkout.customization.appleTouchIconUrl'),
                customTitle: config()->string('maya-sdk.checkout.customization.customTitle'),
                colorScheme: config()->string('maya-sdk.checkout.customization.colorScheme'),
                hideReceiptInput: config()->boolean('maya-sdk.checkout.customization.hideReceiptInput', false),
                skipResultPage: config()->boolean('maya-sdk.checkout.customization.skipResultPage', false),
                showMerchantName: config()->boolean('maya-sdk.checkout.customization.showMerchantName', true),
                redirectTimer: config()->integer('maya-sdk.checkout.customization.redirectTimer', 30),
            )
        );

        $this->info('Done registering customization');

        return self::SUCCESS;
    }
}
