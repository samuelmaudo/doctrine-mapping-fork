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
     * @param ?class-string<EntityRepository> $repositoryClass
     * @param list<ResolvedField|ResolvedEmbedded> $fields
     */
    public function __construct(
        public string $class,
        public ?string $repositoryClass,
        public array $fields,
    ) {}
}
