<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\UniqueConstraint;

use Hereldar\DoctrineMapping\Tests\TestCase;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Name\DefinedName;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Name\EmptyName;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Name\NullName;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Name\UndefinedName;

final class UniqueConstraintNameTest extends TestCase
{
    public function testUndefinedName(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedName::class);

        self::assertArrayHasKey(0, $metadata->table['uniqueConstraints']);
    }

    public function testDefinedName(): void
    {
        $metadata = $this->loadClassMetadata(DefinedName::class);

        self::assertArrayHasKey('uniqueConstraint', $metadata->table['uniqueConstraints']);
    }

    public function testEmptyName(): void
    {
        $metadata = $this->loadClassMetadata(EmptyName::class);

        self::assertArrayHasKey(0, $metadata->table['uniqueConstraints']);
    }

    public function testNullName(): void
    {
        $metadata = $this->loadClassMetadata(NullName::class);

        self::assertArrayHasKey(0, $metadata->table['uniqueConstraints']);
    }
}
