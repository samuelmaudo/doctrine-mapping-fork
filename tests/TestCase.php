<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use PHPUnit\Framework\Constraint\Exception as ExceptionConstraint;
use PHPUnit\Framework\Constraint\ExceptionCode;
use PHPUnit\Framework\Constraint\ExceptionMessage;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Throwable;

abstract class TestCase extends PHPUnitTestCase
{
    private FakerGenerator|null $random = null;

    /**
     * @param Throwable|class-string<Throwable> $expectedException
     *
     * @psalm-suppress InternalClass
     * @psalm-suppress InternalMethod
     */
    public static function assertException(
        Throwable|string $expectedException,
        callable $callback
    ): void {
        $exception = null;

        try {
            $callback();
        } catch (Throwable $exception) {
        }

        if (\is_string($expectedException)) {
            static::assertThat(
                $exception,
                new ExceptionConstraint($expectedException)
            );
        } else {
            static::assertThat(
                $exception,
                new ExceptionConstraint($expectedException::class)
            );
            static::assertThat(
                $exception,
                new ExceptionMessage($expectedException->getMessage())
            );
            static::assertThat(
                $exception,
                new ExceptionCode($expectedException->getCode())
            );
        }
    }

    protected function random(): FakerGenerator
    {
        return $this->random ??= FakerFactory::create();
    }
}
