<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Column;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Column\Length\DefinedLength;
use Hereldar\DoctrineMapping\Tests\Column\Length\NegativeLength;
use Hereldar\DoctrineMapping\Tests\Column\Length\UndefinedLength;
use Hereldar\DoctrineMapping\Tests\Column\Length\ZeroLength;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class ColumnLengthTest extends TestCase
{
    public function testDefinedLength(): void
    {
        $metadata = $this->loadClassMetadata(DefinedLength::class);

        self::assertSame(5, $metadata->fieldMappings['field']['length']);
    }

    public function testUndefinedLength(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedLength::class);

        self::assertNull($metadata->fieldMappings['field']['length']);
    }

    public function testZeroLength(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'ZeroLength.orm.php': Negative or zero length for field 'field'");

        $this->loadClassMetadata(ZeroLength::class);
    }

    public function testNegativeLength(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'NegativeLength.orm.php': Negative or zero length for field 'field'");

        $this->loadClassMetadata(NegativeLength::class);
    }
}
