<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\SequenceGenerator;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\SequenceName\DefinedSequenceName;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\SequenceName\NormalField;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\SequenceName\UndefinedSequenceName;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\SequenceName\EmptySequenceName;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class SequenceGeneratorSequenceNameTest extends TestCase
{
    public function testDefinedSequenceName(): void
    {
        $metadata = $this->loadClassMetadata(DefinedSequenceName::class);

        self::assertTrue($metadata->fieldMappings['id']['id']);
        self::assertSame(2, $metadata->generatorType);
        self::assertSame('sequence', $metadata->sequenceGeneratorDefinition['sequenceName']);
    }

    public function testUndefinedSequenceName(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessageMatches("/Invalid file 'UndefinedSequenceName.orm.php': Too few arguments to function Hereldar\\\\DoctrineMapping\\\\Field::withSequenceGenerator\(\), 0 passed in \S+ on line \d+ and at least \d+ expected/");

        $this->loadClassMetadata(UndefinedSequenceName::class);
    }

    public function testEmptySequenceName(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptySequenceName.orm.php': Empty sequence name for field 'id'");

        $this->loadClassMetadata(EmptySequenceName::class);
    }

    public function testNormalField(): void
    {
        $metadata = $this->loadClassMetadata(NormalField::class);

        self::assertFalse($metadata->fieldMappings['field']['id']);
        self::assertSame(2, $metadata->generatorType);
        self::assertNull($metadata->sequenceGeneratorDefinition);
    }
}
