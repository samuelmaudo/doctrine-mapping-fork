<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\ORM\EntityRepository;

/**
 * @psalm-immutable
 */
final class MappedSuperclass
{
    private function __construct(
        private string $class,
        private ?string $repositoryClass,
        private array $fields = [],
    ) {
    }

    /**
     * @param class-string $class
     * @param ?class-string<EntityRepository> $repositoryClass
     */
    public static function of(
        string $class,
        ?string $repositoryClass = null,
    ): self {
        return new self($class, $repositoryClass);
    }

    /**
     * @param non-empty-list<Field|Embedded> $fields
     */
    public function withFields(
        Field|Embedded ...$fields,
    ): self {
        return new self(
            $this->class,
            $this->repositoryClass,
            $fields,
        );
    }

    public function class(): string
    {
        return $this->class;
    }

    public function repositoryClass(): ?string
    {
        return $this->repositoryClass;
    }

    public function fields(): array
    {
        return $this->fields;
    }
}
