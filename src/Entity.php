<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\ORM\EntityRepository;

/**
 * @psalm-immutable
 */
final class Entity
{
    private function __construct(
        private string $class,
        private ?string $repositoryClass,
        private ?string $table,
        private array $fields,
    ) {}

    /**
     * @param class-string $class
     * @param ?class-string<EntityRepository> $repositoryClass
     * @param ?non-empty-string $table
     */
    public static function of(
        string $class,
        ?string $repositoryClass = null,
        ?string $table = null,
    ): self {
        return new self($class, $repositoryClass, $table, []);
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
            $this->table,
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

    public function table(): ?string
    {
        return $this->table;
    }

    public function fields(): array
    {
        return $this->fields;
    }
}
