<?php

namespace Tests\DeveloperNotifications\Exceptions;

use Kashi326\GooglePlay\DeveloperNotifications\Builders\DeveloperNotificationBuilder;
use Kashi326\GooglePlay\DeveloperNotifications\Exceptions\InvalidDeveloperNotificationArgumentException;
use Tests\TestCase;

/**
 * Class InvalidDeveloperNotificationArgumentExceptionTest.
 */
class InvalidDeveloperNotificationArgumentExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function messages_are_descriptive(): void
    {
        try {
            DeveloperNotificationBuilder::init()->build();
        } catch (InvalidDeveloperNotificationArgumentException $exception) {
            $expectedMessage = sprintf(
                'The property `version` is required, use the %s::setVersion() to set it',
                DeveloperNotificationBuilder::class
            );
            $this->assertEquals($expectedMessage, $exception->getMessage());
        }
    }
}
