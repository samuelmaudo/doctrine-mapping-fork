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
     * @param non-empty-string $table
     * @param ?non-empty-string $schema
     * @param ?non-empty-array<non-empty-string,mixed> $options
     * @param list<ResolvedField|ResolvedEmbedded> $fields
     * @param list<ResolvedIndex> $indexes
     * @param list<ResolvedUniqueConstraint> $uniqueConstraints
     */
    public function __construct(
        public string $class,
        public ?string $repositoryClass,
        public string $table,
        public ?string $schema,
        public ?array $options,
        public array $fields,
        public array $indexes,
        public array $uniqueConstraints,
    ) {}
}
