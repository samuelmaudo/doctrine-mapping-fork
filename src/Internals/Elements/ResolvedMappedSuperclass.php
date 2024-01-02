<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Elements;

use Doctrine\ORM\EntityRepository;

/**
 * @internal
 * @psalm-immutable
 */
final class ResolvedMappedSuperclass
{
    /**
     * @param class-string $class
     * @param list<ResolvedField|ResolvedEmbedded> $properties
     * @param ?class-string<EntityRepository> $repositoryClass
     */
    public function __construct(
        public string $class,
        public array $properties,
        public ?string $repositoryClass,
    ) {}
}
