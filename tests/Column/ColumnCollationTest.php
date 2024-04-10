<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Column;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Column\Collation\DefinedCollation;
use Hereldar\DoctrineMapping\Tests\Column\Collation\EmptyCollation;
use Hereldar\DoctrineMapping\Tests\Column\Collation\UndefinedCollation;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class ColumnCollationTest extends TestCase
{
    public function testDefinedCollation(): void
    {
        $metadata = $this->loadClassMetadata(DefinedCollation::class);

        self::assertFieldOption($metadata, 'field', 'collation', 'latin1_spanish_ci');
    }

    public function testUndefinedCollation(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedCollation::class);

        self::assertFieldOption($metadata, 'field', 'collation', null);
    }

    public function testEmptyCollation(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyCollation.orm.php': Empty collation for field 'field'");

        $this->loadClassMetadata(EmptyCollation::class);
    }
}
