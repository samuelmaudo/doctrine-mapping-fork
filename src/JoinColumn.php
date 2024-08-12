<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;

final class JoinColumn
{
    /**
     * @param non-empty-string|null $name
     * @param non-empty-string $referencedColumnName
     * @param non-empty-string|null $columnDefinition
     * @param array<non-empty-string,mixed> $options
     */
    private function __construct(
        private readonly ?string $name,
        private readonly string $referencedColumnName,
        private readonly bool $unique,
        private readonly bool $nullable,
        private readonly mixed $onDelete,
        private readonly ?string $columnDefinition,
        private readonly array $options,
    ) {}

    /**
     * @param non-empty-string|null $name
     * @param non-empty-string $referencedColumnName
     * @param non-empty-string|null $columnDefinition
     * @param array<non-empty-string,mixed> $options
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
            if (!\is_string($key) || '' === $key) {
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
     * @return non-empty-string|null
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
     * @return non-empty-string|null
     */
    public function columnDefinition(): ?string
    {
        return $this->columnDefinition;
    }

    /**
     * @return array<non-empty-string,mixed>
     */
    public function options(): array
    {
        return $this->options;
    }
}
