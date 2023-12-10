<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Exceptions;

use TypeError;

/**
 * @internal
 */
final class FalseTypeError extends TypeError
{
    /**
     * @param non-empty-string $functionName
     * @param positive-int $argumentNumber
     * @param non-empty-string $argumentName
     */
    public function __construct(
        string $functionName,
        int $argumentNumber,
        string $argumentName,
    ) {
        parent::__construct("{$functionName}: Argument #{$argumentNumber} ({$argumentName}) must be of type false, bool given");
    }
}
