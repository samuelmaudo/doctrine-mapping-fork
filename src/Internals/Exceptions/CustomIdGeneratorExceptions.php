<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Exceptions;

use Doctrine\ORM\Id\AbstractIdGenerator;

trait CustomIdGeneratorExceptions
{
    public static function invalidCustomIdGenerator(string $className): self
    {
        $abstractIdGeneratorClass = AbstractIdGenerator::class;

        return new self("Class '{$className}' is not a valid custom ID generator because does not extend '{$abstractIdGeneratorClass}'");
    }
}
