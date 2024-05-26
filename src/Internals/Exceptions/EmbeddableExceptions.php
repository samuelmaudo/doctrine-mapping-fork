<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Exceptions;

trait EmbeddableExceptions
{
    public static function associationNotAllowed(string $embeddableName, string $associationName): self
    {
        return new self("Embeddables do not allow associations, but association '{$associationName}' was found on embeddable '{$embeddableName}'");
    }
}
