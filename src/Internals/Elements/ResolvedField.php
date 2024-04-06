<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Elements;

use Doctrine\ORM\Id\AbstractIdGenerator;
use Hereldar\DoctrineMapping\Enums\Generated;
use Hereldar\DoctrineMapping\Enums\Strategy;

/**
 * @internal
 * @psalm-immutable
 */
final class ResolvedField
{
    /**
     * @param non-empty-string $property
     * @param ?non-empty-string $type
     * @param ?enum-string $enumType
     * @param ?class-string<AbstractIdGenerator> $customIdGenerator
     */
    public function __construct(
        public string $property,
        public ?string $type,
        public ?string $enumType,
        public bool $id,
        public bool $insertable,
        public bool $updatable,
        public ?Generated $generated,
        public ?Strategy $strategy,
        public ResolvedColumn $column,
        public ?ResolvedSequenceGenerator $sequenceGenerator,
        public ?string $customIdGenerator,
    ) {}
}
