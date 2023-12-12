<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Elements;

use Hereldar\DoctrineMapping\Internals\Exceptions\FalseTypeError;

/**
 * @internal
 * @psalm-immutable
 */
final class ResolvedEmbedded
{
    /**
     * @param non-empty-string $property
     * @param class-string $class
     * @param non-empty-string|false $columnPrefix
     */
    public function __construct(
        public string $property,
        public string $class,
        public string|bool $columnPrefix,
    ) {
        if ($columnPrefix === true) {
            throw new FalseTypeError('ResolvedEmbedded::__construct()', 3, '$columnPrefix');
        }
    }
}
