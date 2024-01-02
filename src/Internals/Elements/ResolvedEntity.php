<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Elements;

use Doctrine\ORM\EntityRepository;

/**
 * @internal
 * @psalm-immutable
 */
final class ResolvedEntity
{
    /**
     * @param class-string $class
     * @param non-empty-string $table
     * @param list<ResolvedField|ResolvedEmbedded> $properties
     * @param ?class-string<EntityRepository> $repositoryClass
     */
    public function __construct(
        public string $class,
        public string $table,
        public array $properties,
        public ?string $repositoryClass,
    ) {}
}
