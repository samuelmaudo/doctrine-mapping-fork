<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Field\Strategy\AutoStrategy;
use Hereldar\DoctrineMapping\Tests\Field\Strategy\CustomStrategy;
use Hereldar\DoctrineMapping\Tests\Field\Strategy\IdentityStrategy;
use Hereldar\DoctrineMapping\Tests\Field\Strategy\InvalidStrategy;
use Hereldar\DoctrineMapping\Tests\Field\Strategy\NoneStrategy;
use Hereldar\DoctrineMapping\Tests\Field\Strategy\NullStrategy;
use Hereldar\DoctrineMapping\Tests\Field\Strategy\SequenceStrategy;
use Hereldar\DoctrineMapping\Tests\Field\Strategy\UndefinedStrategy;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldStrategyTest extends TestCase
{
    public function testAutoStrategy(): void
    {
        $metadata = $this->loadClassMetadata(AutoStrategy::class);

        self::assertSame(1, $metadata->generatorType);

        self::assertFalse($metadata->isIdentifierNatural());
        self::assertTrue($metadata->usesIdGenerator());
        self::assertFalse($metadata->isIdGeneratorSequence());
        self::assertFalse($metadata->isIdGeneratorIdentity());
    }

    public function testSequenceStrategy(): void
    {
        $metadata = $this->loadClassMetadata(SequenceStrategy::class);

        self::assertSame(2, $metadata->generatorType);

        self::assertFalse($metadata->isIdentifierNatural());
        self::assertTrue($metadata->usesIdGenerator());
        self::assertTrue($metadata->isIdGeneratorSequence());
        self::assertFalse($metadata->isIdGeneratorIdentity());
    }

    public function testIdentityStrategy(): void
    {
        $metadata = $this->loadClassMetadata(IdentityStrategy::class);

        self::assertSame(4, $metadata->generatorType);

        self::assertFalse($metadata->isIdentifierNatural());
        self::assertTrue($metadata->usesIdGenerator());
        self::assertFalse($metadata->isIdGeneratorSequence());
        self::assertTrue($metadata->isIdGeneratorIdentity());
    }

    public function testNoneStrategy(): void
    {
        $metadata = $this->loadClassMetadata(NoneStrategy::class);

        self::assertSame(5, $metadata->generatorType);

        self::assertTrue($metadata->isIdentifierNatural());
        self::assertFalse($metadata->usesIdGenerator());
    }

    public function testCustomStrategy(): void
    {
        $metadata = $this->loadClassMetadata(CustomStrategy::class);

        self::assertSame(7, $metadata->generatorType);

        self::assertFalse($metadata->isIdentifierNatural());
        self::assertTrue($metadata->usesIdGenerator());
        self::assertFalse($metadata->isIdGeneratorSequence());
        self::assertFalse($metadata->isIdGeneratorIdentity());
    }

    public function testNullStrategy(): void
    {
        $metadata = $this->loadClassMetadata(NullStrategy::class);

        self::assertSame(5, $metadata->generatorType);

        self::assertTrue($metadata->isIdentifierNatural());
        self::assertFalse($metadata->usesIdGenerator());
    }

    public function testUndefinedStrategy(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedStrategy::class);

        self::assertSame(5, $metadata->generatorType);

        self::assertTrue($metadata->isIdentifierNatural());
        self::assertFalse($metadata->usesIdGenerator());
    }

    public function testInvalidStrategy(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'InvalidStrategy.orm.php': Invalid generation strategy 'UNKNOWN' for property 'field' on class '".InvalidStrategy::class."'");

        $this->loadClassMetadata(InvalidStrategy::class);
    }
}
