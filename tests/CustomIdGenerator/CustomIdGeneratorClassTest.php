<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\CustomIdGenerator;

use Doctrine\ORM\Id\AbstractIdGenerator;
use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\AnonymousClass;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\EmptyClass;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\ExistingClass;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\ExistingIdGenerator;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\InvalidClass;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\NonExistingClass;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\UndefinedClass;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class CustomIdGeneratorClassTest extends TestCase
{
    public function testUndefinedClass(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessageMatches("/Invalid file 'UndefinedClass.orm.php': Too few arguments to function Hereldar\\\\DoctrineMapping\\\\AbstractId::withCustomIdGenerator\\(\\), 0 passed in \\S+ on line \\d+ and exactly 1 expected/");

        $this->loadClassMetadata(UndefinedClass::class);
    }

    public function testExistingClass(): void
    {
        $metadata = $this->loadClassMetadata(ExistingClass::class);

        self::assertFieldId($metadata, 'id', true);
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

    public function testInvalidClass(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'InvalidClass.orm.php': Class 'InvalidIdGenerator' is not a valid custom ID generator because does not extend '".AbstractIdGenerator::class."'");

        $this->loadClassMetadata(InvalidClass::class);
    }
}
