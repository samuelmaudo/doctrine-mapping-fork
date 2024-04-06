<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\UniqueConstraint;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Options\DefinedOptions;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Options\EmptyOption;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Options\EmptyOptions;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Options\InvalidOption;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Options\NullOptions;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Options\UndefinedOptions;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class UniqueConstraintOptionsTest extends TestCase
{
    public function testUndefinedOptions(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedOptions::class);

        self::assertNull($metadata->table['uniqueConstraints'][0]['options']);
    }

    public function testDefinedOptions(): void
    {
        $metadata = $this->loadClassMetadata(DefinedOptions::class);

        self::assertSame(['key' => 'value'], $metadata->table['uniqueConstraints'][0]['options']);
    }

    public function testEmptyOptions(): void
    {
        $metadata = $this->loadClassMetadata(EmptyOptions::class);

        self::assertNull($metadata->table['uniqueConstraints'][0]['options']);
    }

    public function testEmptyOption(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyOption.orm.php': Option keys of unique constraints should be non-empty strings, but '' was found");

        $this->loadClassMetadata(EmptyOption::class);
    }

    public function testInvalidOption(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'InvalidOption.orm.php': Option keys of unique constraints should be non-empty strings, but 42 was found");

        $this->loadClassMetadata(InvalidOption::class);
    }

    public function testNullOptions(): void
    {
        $metadata = $this->loadClassMetadata(NullOptions::class);

        self::assertNull($metadata->table['uniqueConstraints'][0]['options']);
    }
}
