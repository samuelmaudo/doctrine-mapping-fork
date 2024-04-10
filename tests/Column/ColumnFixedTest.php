<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Column;

use Hereldar\DoctrineMapping\Tests\Column\Fixed\DefinedFixed;
use Hereldar\DoctrineMapping\Tests\Column\Fixed\UndefinedFixed;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class ColumnFixedTest extends TestCase
{
    public function testDefinedFixed(): void
    {
        $metadata = $this->loadClassMetadata(DefinedFixed::class);

        self::assertFieldOption($metadata, 'id', 'fixed', true);
        self::assertFieldOption($metadata, 'field', 'fixed', false);
    }

    public function testUndefinedFixed(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedFixed::class);

        self::assertFieldOption($metadata, 'field', 'fixed', null);
    }
}
