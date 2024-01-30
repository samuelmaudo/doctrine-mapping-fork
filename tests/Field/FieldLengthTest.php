<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Field\Length\DefinedLength;
use Hereldar\DoctrineMapping\Tests\Field\Length\NegativeLength;
use Hereldar\DoctrineMapping\Tests\Field\Length\UndefinedLength;
use Hereldar\DoctrineMapping\Tests\Field\Length\ZeroLength;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldLengthTest extends TestCase
{
    public function testDefinedLength(): void
    {
        $metadata = $this->loadClassMetadata(DefinedLength::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertSame(5, $metadata->fieldMappings['field']['length']);
    }

    public function testUndefinedLength(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedLength::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertNull($metadata->fieldMappings['field']['length']);
    }

    public function testZeroLength(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'ZeroLength.orm.php': Length for property 'field' on class '".ZeroLength::class."' is negative or zero");

        $this->loadClassMetadata(ZeroLength::class);
    }

    public function testNegativeLength(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'NegativeLength.orm.php': Length for property 'field' on class '".NegativeLength::class."' is negative or zero");

        $this->loadClassMetadata(NegativeLength::class);
    }
}
