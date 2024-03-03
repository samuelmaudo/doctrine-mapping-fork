<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Index;

use Hereldar\DoctrineMapping\Tests\Index\Name\DefinedName;
use Hereldar\DoctrineMapping\Tests\Index\Name\EmptyName;
use Hereldar\DoctrineMapping\Tests\Index\Name\NullName;
use Hereldar\DoctrineMapping\Tests\Index\Name\UndefinedName;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class IndexNameTest extends TestCase
{
    public function testUndefinedName(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedName::class);

        self::assertArrayHasKey(0, $metadata->table['indexes']);
    }

    public function testDefinedName(): void
    {
        $metadata = $this->loadClassMetadata(DefinedName::class);

        self::assertArrayHasKey('index', $metadata->table['indexes']);
    }

    public function testEmptyName(): void
    {
        $metadata = $this->loadClassMetadata(EmptyName::class);

        self::assertArrayHasKey(0, $metadata->table['indexes']);
    }

    public function testNullName(): void
    {
        $metadata = $this->loadClassMetadata(NullName::class);

        self::assertArrayHasKey(0, $metadata->table['indexes']);
    }
}
