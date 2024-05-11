<?php

namespace Kashi326\GooglePlay\DeveloperNotifications\Factories;

use Kashi326\GooglePlay\DeveloperNotifications\Contracts\NotificationPayload;
use Kashi326\GooglePlay\DeveloperNotifications\OneTimePurchaseNotification;
use Kashi326\GooglePlay\DeveloperNotifications\SubscriptionNotification;
use Kashi326\GooglePlay\DeveloperNotifications\TestNotification;

/**
 * Class NotificationPayloadFactory
 * This is tested on @see {Kashi326\GooglePlay\Tests\DeveloperNotifications\DeveloperNotificationTest}.
 */
class NotificationPayloadFactory
{
    public static function create(array $data): NotificationPayload
    {
        if (isset($data[NotificationPayload::ONE_TIME_PRODUCT_NOTIFICATION])) {
            return OneTimePurchaseNotification::create($data[NotificationPayload::ONE_TIME_PRODUCT_NOTIFICATION]);
        }

        if (isset($data[NotificationPayload::SUBSCRIPTION_NOTIFICATION])) {
            return SubscriptionNotification::create($data[NotificationPayload::SUBSCRIPTION_NOTIFICATION]);
        }

        return new TestNotification($data['version']);
    }
}
