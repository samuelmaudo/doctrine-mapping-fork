<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;

/**
 * @psalm-immutable
 */
final class JoinColumn
{
    /**
     * @param ?non-empty-string $name
     * @param non-empty-string $referencedColumnName
     * @param ?non-empty-string $columnDefinition
     * @param non-empty-array<non-empty-string,mixed> $options
     */
    private function __construct(
        private string|null $name,
        private string $referencedColumnName,
        private bool $unique,
        private bool $nullable,
        private mixed $onDelete,
        private string|null $columnDefinition,
        private array $options,
    ) {}

    /**
     * @param non-empty-string|null $name
     * @param non-empty-string $referencedColumnName
     * @param non-empty-string|null $columnDefinition
     * @param non-empty-array<non-empty-string,mixed> $options
     *
     * @throws DoctrineMappingException
     */
    public static function of(
        ?string $name = null,
        string $referencedColumnName = 'id',
        bool $unique = false,
        bool $nullable = true,
        mixed $onDelete = null,
        ?string $columnDefinition = null,
        array $options = [],
    ): self {
        if ('' === $name) {
            throw MappingException::emptyJoinColumName($name);
        }

        if ('' === $referencedColumnName) {
            throw MappingException::emptyJoinReferencedColumName($name);
        }

        if ('' === $columnDefinition) {
            throw MappingException::emptyJoinColumnDefinition($name);
        }

        foreach ($options as $key => $value) {
            if (!is_string($key) || '' === $key) {
                throw MappingException::invalidJoinColumnOption(
                    $name,
                    $key,
                );
            }
        }

        return new self(
            $name,
            $referencedColumnName,
            $unique,
            $nullable,
            $onDelete,
            $columnDefinition,
            $options,
        );
    }

    /**
     * @return ?non-empty-string
     */
    public function name(): ?string
    {
        return $this->name;
    }

    /**
     * @return non-empty-string
     */
    public function referencedColumnName(): string
    {
        return $this->referencedColumnName;
    }

    public function unique(): bool
    {
        return $this->unique;
    }

    public function nullable(): bool
    {
        return $this->nullable;
    }

    public function onDelete(): mixed
    {
        return $this->onDelete;
    }

    /**
     * @return ?non-empty-string
     */
    public function columnDefinition(): ?string
    {
        return $this->columnDefinition;
    }

    /**
     * @return non-empty-array<non-empty-string,mixed>
     */
    public function options(): array
    {
        return $this->options;
    }
}
