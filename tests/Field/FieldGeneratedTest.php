<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Field\Generated\AlwaysGenerated;
use Hereldar\DoctrineMapping\Tests\Field\Generated\InsertGenerated;
use Hereldar\DoctrineMapping\Tests\Field\Generated\InvalidGenerated;
use Hereldar\DoctrineMapping\Tests\Field\Generated\NeverGenerated;
use Hereldar\DoctrineMapping\Tests\Field\Generated\NullGenerated;
use Hereldar\DoctrineMapping\Tests\Field\Generated\UndefinedGenerated;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldGeneratedTest extends TestCase
{
    public function testNeverGenerated(): void
    {
        $metadata = $this->loadClassMetadata(NeverGenerated::class);

        self::assertFieldGenerated($metadata, 'id', null);
        self::assertFieldGenerated($metadata, 'field', null);
    }

    public function testInsertGenerated(): void
    {
        $metadata = $this->loadClassMetadata(InsertGenerated::class);

        self::assertFieldGenerated($metadata, 'id', 1);
        self::assertFieldGenerated($metadata, 'field', 1);
    }

    public function testAlwaysGenerated(): void
    {
        $metadata = $this->loadClassMetadata(AlwaysGenerated::class);

        self::assertFieldGenerated($metadata, 'id', 2);
        self::assertFieldGenerated($metadata, 'field', 2);
    }

    public function testNullGenerated(): void
    {
        $metadata = $this->loadClassMetadata(NullGenerated::class);

        self::assertFieldGenerated($metadata, 'field', null);
    }

    public function testUndefinedGenerated(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedGenerated::class);

        self::assertFieldGenerated($metadata, 'field', null);
    }

    public function testInvalidGenerated(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'InvalidGenerated.orm.php': Invalid generation mode 'UNKNOWN' for field 'field'");

        $this->loadClassMetadata(InvalidGenerated::class);
    }
}
