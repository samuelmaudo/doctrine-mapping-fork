<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Field\Generated\DefinedGenerated;
use Hereldar\DoctrineMapping\Tests\Field\Generated\InvalidGenerated;
use Hereldar\DoctrineMapping\Tests\Field\Generated\UndefinedGenerated;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldGeneratedTest extends TestCase
{
    public function testDefinedGenerated(): void
    {
        $metadata = $this->loadClassMetadata(DefinedGenerated::class);

        self::assertArrayNotHasKey('generated', $metadata->fieldMappings['never']);
        self::assertSame(1, $metadata->fieldMappings['insert']['generated']);
        self::assertSame(2, $metadata->fieldMappings['always']['generated']);
        self::assertNull($metadata->fieldMappings['null']['generated']);
    }

    public function testUndefinedGenerated(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedGenerated::class);

        self::assertNull($metadata->fieldMappings['field']['generated']);
    }

    public function testInvalidGenerated(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'InvalidGenerated.orm.php': Invalid generated mode '4'");

        $this->loadClassMetadata(InvalidGenerated::class);
    }
}
