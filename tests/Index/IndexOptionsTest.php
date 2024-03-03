<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Index;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Index\Options\DefinedOptions;
use Hereldar\DoctrineMapping\Tests\Index\Options\EmptyOption;
use Hereldar\DoctrineMapping\Tests\Index\Options\EmptyOptions;
use Hereldar\DoctrineMapping\Tests\Index\Options\InvalidOption;
use Hereldar\DoctrineMapping\Tests\Index\Options\NullOptions;
use Hereldar\DoctrineMapping\Tests\Index\Options\UndefinedOptions;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class IndexOptionsTest extends TestCase
{
    public function testUndefinedOptions(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedOptions::class);

        self::assertNull($metadata->table['indexes'][0]['options']);
    }

    public function testDefinedOptions(): void
    {
        $metadata = $this->loadClassMetadata(DefinedOptions::class);

        self::assertSame(['key' => 'value'], $metadata->table['indexes'][0]['options']);
    }

    public function testEmptyOptions(): void
    {
        $metadata = $this->loadClassMetadata(EmptyOptions::class);

        self::assertNull($metadata->table['indexes'][0]['options']);
    }

    public function testEmptyOption(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyOption.orm.php': Option keys of index '1' for class '".EmptyOption::class."' should be non-empty strings, but '' was found");

        $this->loadClassMetadata(EmptyOption::class);
    }

    public function testInvalidOption(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'InvalidOption.orm.php': Option keys of index '1' for class '".InvalidOption::class."' should be non-empty strings, but 42 was found");

        $this->loadClassMetadata(InvalidOption::class);
    }

    public function testNullOptions(): void
    {
        $metadata = $this->loadClassMetadata(NullOptions::class);

        self::assertNull($metadata->table['indexes'][0]['options']);
    }
}
