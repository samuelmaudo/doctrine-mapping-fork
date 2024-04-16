<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Exceptions;

trait SequenceGeneratorExceptions
{
    public static function emptySequenceName(string $fieldName): self
    {
        return new self("Empty sequence name for field '{$fieldName}'");
    }

    public static function nonPositiveAllocationSize(string $fieldName): self
    {
        return new self("Negative or zero allocation size for field '{$fieldName}'");
    }

    public static function nonPositiveInitialValue(string $fieldName): self
    {
        return new self("Negative or zero initial value for field '{$fieldName}'");
    }
}
