<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\GeneratedValue;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\AutoStrategy;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\CustomStrategy;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\IdentityStrategy;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\InvalidStrategy;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\NoneStrategy;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\SequenceStrategy;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\UndefinedStrategy;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class GeneratedValueStrategyTest extends TestCase
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

    public function testUndefinedStrategy(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedStrategy::class);

        self::assertSame(1, $metadata->generatorType);

        self::assertFalse($metadata->isIdentifierNatural());
        self::assertTrue($metadata->usesIdGenerator());
        self::assertFalse($metadata->isIdGeneratorSequence());
        self::assertFalse($metadata->isIdGeneratorIdentity());
    }

    public function testInvalidStrategy(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'InvalidStrategy.orm.php': Invalid generation strategy 'UNKNOWN' for field 'field'");

        $this->loadClassMetadata(InvalidStrategy::class);
    }
}
