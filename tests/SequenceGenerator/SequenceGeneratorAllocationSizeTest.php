<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\SequenceGenerator;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\AllocationSize\DefinedAllocationSize;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\AllocationSize\NegativeAllocationSize;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\AllocationSize\NormalField;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\AllocationSize\UndefinedAllocationSize;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\AllocationSize\ZeroAllocationSize;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class SequenceGeneratorAllocationSizeTest extends TestCase
{
    public function testDefinedAllocationSize(): void
    {
        $metadata = $this->loadClassMetadata(DefinedAllocationSize::class);

        self::assertTrue($metadata->fieldMappings['id']['id']);
        self::assertSame(2, $metadata->generatorType);
        self::assertEquals(5, $metadata->sequenceGeneratorDefinition['allocationSize']);
    }

    public function testUndefinedAllocationSize(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedAllocationSize::class);

        self::assertTrue($metadata->fieldMappings['id']['id']);
        self::assertSame(2, $metadata->generatorType);
        self::assertEquals(1, $metadata->sequenceGeneratorDefinition['allocationSize']);
    }

    public function testZeroAllocationSize(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'ZeroAllocationSize.orm.php': Negative or zero allocation size for field 'id'");

        $this->loadClassMetadata(ZeroAllocationSize::class);
    }

    public function testNegativeAllocationSize(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'NegativeAllocationSize.orm.php': Negative or zero allocation size for field 'id'");

        $this->loadClassMetadata(NegativeAllocationSize::class);
    }

    public function testNormalField(): void
    {
        $metadata = $this->loadClassMetadata(NormalField::class);

        self::assertFalse($metadata->fieldMappings['field']['id']);
        self::assertSame(2, $metadata->generatorType);
        self::assertNull($metadata->sequenceGeneratorDefinition);
    }
}
