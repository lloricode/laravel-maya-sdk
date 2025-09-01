<?php

declare(strict_types=1);

use Lloricode\Paymaya\Enums\Environment;
use Lloricode\Paymaya\Enums\Webhook;

/**
 * @todo: Manage Exception using laravel logs, allow set config log files
 */

return [
    'mode' => env('MAYA_MODE', Environment::Sandbox->value),
    'keys' => [
        'public' => env('MAYA_PUBLIC_KEY'),
        'secret' => env('MAYA_SECRET_KEY'),
    ],

    /**
     * Webhooks
     */
    'webhooks' => [
        Webhook::CHECKOUT_SUCCESS => 'api/payment-callback/maya/success',
        Webhook::CHECKOUT_FAILURE => 'api/payment-callback/maya/failure',
        Webhook::CHECKOUT_DROPOUT => 'api/payment-callback/maya/dropout',

        //        Webhook::PAYMENT_SUCCESS => 'api/test/success',
        //        Webhook::PAYMENT_EXPIRED => 'api/test/expired',
        //        Webhook::PAYMENT_FAILED => 'api/test/failed',
    ],

    'checkout' => [
        'customization' => [
            'logoUrl' => 'https://image1.png',
            'iconUrl' => 'https://image2.png',
            'appleTouchIconUrl' => 'https://image3.png',
            'customTitle' => 'test maya sandbox title',
            'colorScheme' => '#e01c44',
            'redirectTimer' => 3,
            //            'hideReceiptInput' => true,
            //            'skipResultPage' => false,
            //            'showMerchantName' => true,
        ],
    ],
];
