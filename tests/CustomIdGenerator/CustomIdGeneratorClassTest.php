<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\CustomIdGenerator;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\AnonymousClass;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\EmptyClass;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\ExistingClass;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\ExistingIdGenerator;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\NonExistingClass;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\NormalField;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\UndefinedClass;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class CustomIdGeneratorClassTest extends TestCase
{
    public function testUndefinedClass(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedClass::class);

        self::assertTrue($metadata->fieldMappings['id']['id']);
        self::assertSame(7, $metadata->generatorType);
        self::assertSame(['class' => null], $metadata->customGeneratorDefinition);
    }

    public function testExistingClass(): void
    {
        $metadata = $this->loadClassMetadata(ExistingClass::class);

        self::assertTrue($metadata->fieldMappings['id']['id']);
        self::assertSame(7, $metadata->generatorType);
        self::assertSame(['class' => ExistingIdGenerator::class], $metadata->customGeneratorDefinition);
    }

    public function testNonExistingClass(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'NonExistingClass.orm.php': Class 'NonExistingIdGenerator' does not exist");

        $this->loadClassMetadata(NonExistingClass::class);
    }

    public function testEmptyClass(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyClass.orm.php': Class name cannot be empty");

        $this->loadClassMetadata(EmptyClass::class);
    }

    public function testAnonymousClass(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessageMatches("/Invalid file 'AnonymousClass.orm.php': Class 'class@anonymous[^']*' is anonymous/");

        $this->loadClassMetadata(AnonymousClass::class);
    }

    public function testNormalField(): void
    {
        $metadata = $this->loadClassMetadata(NormalField::class);

        self::assertFalse($metadata->fieldMappings['field']['id']);
        self::assertSame(7, $metadata->generatorType);
        self::assertNull($metadata->customGeneratorDefinition);
    }
}
