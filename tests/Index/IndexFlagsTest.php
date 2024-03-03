<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Index;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Index\Flags\DefinedFlag;
use Hereldar\DoctrineMapping\Tests\Index\Flags\DefinedFlags;
use Hereldar\DoctrineMapping\Tests\Index\Flags\EmptyFlag;
use Hereldar\DoctrineMapping\Tests\Index\Flags\EmptyFlags;
use Hereldar\DoctrineMapping\Tests\Index\Flags\InvalidFlag;
use Hereldar\DoctrineMapping\Tests\Index\Flags\NullFlags;
use Hereldar\DoctrineMapping\Tests\Index\Flags\UndefinedFlags;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class IndexFlagsTest extends TestCase
{
    public function testUndefinedFlags(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedFlags::class);

        self::assertNull($metadata->table['indexes'][0]['flags']);
    }

    public function testDefinedFlags(): void
    {
        $metadata = $this->loadClassMetadata(DefinedFlags::class);

        self::assertSame(['flag1', 'flag2'], $metadata->table['indexes'][0]['flags']);
    }

    public function testDefinedFlag(): void
    {
        $metadata = $this->loadClassMetadata(DefinedFlag::class);

        self::assertSame(['flag'], $metadata->table['indexes'][0]['flags']);
    }

    public function testEmptyFlags(): void
    {
        $metadata = $this->loadClassMetadata(EmptyFlags::class);

        self::assertNull($metadata->table['indexes'][0]['flags']);
    }

    public function testEmptyFlag(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyFlag.orm.php': Flag list of index '1' for class '".EmptyFlag::class."' should contain non-empty strings, but '' was found");

        $this->loadClassMetadata(EmptyFlag::class);
    }

    public function testInvalidFlag(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'InvalidFlag.orm.php': Flag list of index '1' for class '".InvalidFlag::class."' should contain non-empty strings, but 42 was found");

        $this->loadClassMetadata(InvalidFlag::class);
    }

    public function testNullFlags(): void
    {
        $metadata = $this->loadClassMetadata(NullFlags::class);

        self::assertNull($metadata->table['indexes'][0]['flags']);
    }
}
