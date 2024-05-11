<?php

namespace Kashi326\GooglePlay\DeveloperNotifications\Contracts;

use Kashi326\GooglePlay\ValueObjects\Time;

/**
 * Interface RealTimeDeveloperNotification.
 */
interface RealTimeDeveloperNotification
{
    public function getType(): string;

    public function getVersion(): string;

    public function getPackageName(): string;

    public function getEventTime(): Time;

    public function getPayload(): NotificationPayload;
}
