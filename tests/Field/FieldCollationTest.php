<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Field\Collation\DefinedCollation;
use Hereldar\DoctrineMapping\Tests\Field\Collation\EmptyCollation;
use Hereldar\DoctrineMapping\Tests\Field\Collation\UndefinedCollation;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldCollationTest extends TestCase
{
    public function testDefinedCollation(): void
    {
        $metadata = $this->loadClassMetadata(DefinedCollation::class);

        self::assertSame('latin1_spanish_ci', $metadata->fieldMappings['field']['options']['collation']);
    }

    public function testUndefinedCollation(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedCollation::class);

        self::assertNull($metadata->fieldMappings['field']['options']['collation']);
    }

    public function testEmptyCollation(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyCollation.orm.php': Collation for property 'field' on class '".EmptyCollation::class."' is empty");

        $this->loadClassMetadata(EmptyCollation::class);
    }
}
