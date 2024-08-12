<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Interfaces\FieldLike;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;

final class Column
{
    /**
     * @param non-empty-string|null $name
     * @param non-empty-string|null $definition
     * @param positive-int|null $length
     * @param non-negative-int|null $precision
     * @param non-negative-int|null $scale
     * @param non-empty-string|null $charset
     * @param non-empty-string|null $collation
     * @param non-empty-string|null $comment
     */
    private function __construct(
        private readonly ?string $name = null,
        private readonly ?string $definition = null,
        private readonly bool $unique = false,
        private readonly ?bool $nullable = null,
        private readonly ?int $length = null,
        private readonly ?int $precision = null,
        private readonly ?int $scale = null,
        private readonly mixed $default = null,
        private readonly ?bool $unsigned = null,
        private readonly ?bool $fixed = null,
        private readonly ?string $charset = null,
        private readonly ?string $collation = null,
        private readonly ?string $comment = null,
    ) {}

    /**
     * @param non-empty-string|null $name
     * @param non-empty-string|null $definition
     * @param positive-int|null $length
     * @param non-negative-int|null $precision
     * @param non-negative-int|null $scale
     * @param non-empty-string|null $charset
     * @param non-empty-string|null $collation
     * @param non-empty-string|null $comment
     *
     * @throws DoctrineMappingException
     */
    public static function of(
        FieldLike $field,
        ?string $name = null,
        ?string $definition = null,
        bool $unique = false,
        bool $nullable = false,
        ?int $length = null,
        ?int $precision = null,
        ?int $scale = null,
        mixed $default = null,
        ?bool $unsigned = null,
        ?bool $fixed = null,
        ?string $charset = null,
        ?string $collation = null,
        ?string $comment = null,
    ): self {
        if ('' === $name) {
            throw MappingException::emptyColumnName($field->property());
        }

        if ('' === $definition) {
            throw MappingException::emptyColumnDefinition($field->property());
        }

        if (true === $nullable && $field instanceof AbstractId) {
            throw MappingException::nullableId($field->property());
        }

        if (null !== $length && 1 > $length) {
            throw MappingException::nonPositiveLength($field->property());
        }

        if (null !== $precision && 1 > $precision) {
            throw MappingException::nonPositivePrecision($field->property());
        }

        if (null !== $scale) {
            if (1 > $scale) {
                throw MappingException::nonPositiveScale($field->property());
            }
            if (null === $precision) {
                throw MappingException::missingPrecision($field->property());
            }
            if ($scale > $precision) {
                throw MappingException::scaleGreaterThanPrecision($field->property());
            }
        }

        if ('' === $charset) {
            throw MappingException::emptyCharset($field->property());
        }

        if ('' === $collation) {
            throw MappingException::emptyCollation($field->property());
        }

        return new self(
            $name,
            $definition,
            $unique,
            $nullable,
            $length,
            $precision,
            $scale,
            $default,
            $unsigned,
            $fixed,
            $charset,
            $collation,
            $comment ?: null,
        );
    }

    public static function empty(): self
    {
        return new self(
            null,
            null,
            false,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
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
     * @return non-empty-string|null
     */
    public function definition(): ?string
    {
        return $this->definition;
    }

    public function unique(): bool
    {
        return $this->unique;
    }

    public function nullable(): ?bool
    {
        return $this->nullable;
    }

    /**
     * @return positive-int|null
     */
    public function length(): ?int
    {
        return $this->length;
    }

    /**
     * @return non-negative-int|null
     */
    public function precision(): ?int
    {
        return $this->precision;
    }

    /**
     * @return non-negative-int|null
     */
    public function scale(): ?int
    {
        return $this->scale;
    }

    public function default(): mixed
    {
        return $this->default;
    }

    public function unsigned(): ?bool
    {
        return $this->unsigned;
    }

    public function fixed(): ?bool
    {
        return $this->fixed;
    }

    /**
     * @return non-empty-string|null
     */
    public function charset(): ?string
    {
        return $this->charset;
    }

    /**
     * @return non-empty-string|null
     */
    public function collation(): ?string
    {
        return $this->collation;
    }

    /**
     * @return non-empty-string|null
     */
    public function comment(): ?string
    {
        return $this->comment;
    }
}
