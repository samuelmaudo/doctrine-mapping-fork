<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Enums\Cascade;
use Hereldar\DoctrineMapping\Enums\Fetch;
use Hereldar\DoctrineMapping\Internals\Resolvers\ClassResolver;
use ReflectionClass;

final class OneToMany extends Association
{
    /**
     * @param non-empty-string $property
     * @phpstan-param ReflectionClass<object> $targetEntity
     * @param non-empty-string|null $mappedBy
     * @param list<Cascade> $cascade
     * @param non-empty-string|null $indexBy
     *
     * @internal
     */
    public function __construct(
        protected readonly string $property,
        protected readonly ReflectionClass $targetEntity,
        protected readonly ?string $mappedBy,
        protected readonly array $cascade,
        protected readonly Fetch $fetch,
        protected readonly bool $orphanRemoval,
        protected readonly ?string $indexBy,
        protected readonly ?OrderBy $orderBy,
    ) {}

    /**
     * @param non-empty-string $property
     * @param class-string|null $targetEntity
     * @param non-empty-string|null $mappedBy
     * @param list<Cascade|'all'|'remove'|'persist'|'refresh'|'detach'> $cascade
     * @param Fetch|'LAZY'|'EAGER'|'EXTRA_LAZY' $fetch
     * @param non-empty-string|null $indexBy
     *
     * @throws DoctrineMappingException
     */
    public static function of(
        string $property,
        ?string $targetEntity = null,
        ?string $mappedBy = null,
        array $cascade = [],
        Fetch|string $fetch = 'LAZY',
        bool $orphanRemoval = false,
        ?string $indexBy = null,
    ): self|IncompleteOneToMany {
        self::validateProperty($property);
        $targetEntity = ClassResolver::resolveNullable($targetEntity);
        self::validateMappedBy($property, $targetEntity, $mappedBy);
        $cascade = self::sanitizeCascade($property, $cascade);
        $fetch = self::sanitizeFetch($property, $fetch);
        self::validateIndexBy($property, $targetEntity, $indexBy);

        if (null === $targetEntity) {
            return new IncompleteOneToMany($property, $mappedBy, $cascade, $fetch, $orphanRemoval, $indexBy, null);
        }

        // @phpstan-ignore deadCode.unreachable
        return new self($property, $targetEntity, $mappedBy, $cascade, $fetch, $orphanRemoval, $indexBy, null);
    }

    /**
     * @param non-empty-array<non-empty-string,'ASC'|'DESC'> $value
     *
     * @throws DoctrineMappingException
     */
    public function withOrderBy(
        array $value,
    ): self {
        return new self(
            $this->property,
            $this->targetEntity,
            $this->mappedBy,
            $this->cascade,
            $this->fetch,
            $this->orphanRemoval,
            $this->indexBy,
            OrderBy::of($this, $value),
        );
    }

    /**
     * @return non-empty-string|null
     */
    public function mappedBy(): ?string
    {
        return $this->mappedBy;
    }

    public function orphanRemoval(): bool
    {
        return $this->orphanRemoval;
    }

    /**
     * @return non-empty-string|null
     */
    public function indexBy(): ?string
    {
        return $this->indexBy;
    }

    public function orderBy(): ?OrderBy
    {
        return $this->orderBy;
    }
}
