<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use function Hereldar\DoctrineMapping\Internals\to_snake_case;

/**
 * @psalm-immutable
 */
final class Column
{
    /**
     * @param ?non-empty-string $name
     * @param ?non-empty-string $definition
     * @param ?positive-int $length
     * @param ?non-negative-int $precision
     * @param ?non-negative-int $scale
     * @param ?non-empty-string $charset
     * @param ?non-empty-string $collation
     * @param ?non-empty-string $comment
     */
    private function __construct(
        private ?string $name = null,
        private ?string $definition = null,
        private bool $unique = false,
        private ?bool $nullable = null,
        private ?int $length = null,
        private ?int $precision = null,
        private ?int $scale = null,
        private mixed $default = null,
        private ?bool $unsigned = null,
        private ?bool $fixed = null,
        private ?string $charset = null,
        private ?string $collation = null,
        private ?string $comment = null,
    ) {}

    /**
     * @param ?non-empty-string $name
     * @param ?non-empty-string $definition
     * @param ?positive-int $length
     * @param ?non-negative-int $precision
     * @param ?non-negative-int $scale
     * @param ?non-empty-string $charset
     * @param ?non-empty-string $collation
     * @param ?non-empty-string $comment
     *
     * @throws DoctrineMappingException
     */
    public static function of(
        Field $field,
        ?string $name = null,
        ?string $definition = null,
        bool $unique = false,
        ?bool $nullable = null,
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
        if ($name === null) {
            $name = to_snake_case($field->property());
        } elseif ($name === '') {
            throw MappingException::emptyColumnName($field->property());
        }

        if ($definition === '') {
            throw MappingException::emptyColumnDefinition($field->property());
        }

        if ($nullable === true && $field->id()) {
            throw MappingException::nullableId($field->property());
        }

        if ($length !== null && $length < 1) {
            throw MappingException::nonPositiveLength($field->property());
        }

        if ($precision !== null && $precision < 1) {
            throw MappingException::nonPositivePrecision($field->property());
        }

        if ($scale !== null) {
            if ($scale < 1) {
                throw MappingException::nonPositiveScale($field->property());
            }
            if ($precision === null) {
                throw MappingException::missingPrecision($field->property());
            }
            if ($scale > $precision) {
                throw MappingException::scaleGreaterThanPrecision($field->property());
            }
        }

        if ($charset === '') {
            throw MappingException::emptyCharset($field->property());
        }

        if ($collation === '') {
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
     * @return ?non-empty-string
     */
    public function name(): ?string
    {
        return $this->name;
    }

    /**
     * @return ?non-empty-string
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
     * @return ?positive-int
     */
    public function length(): ?int
    {
        return $this->length;
    }

    /**
     * @return ?non-negative-int
     */
    public function precision(): ?int
    {
        return $this->precision;
    }

    /**
     * @return ?non-negative-int
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
     * @return ?non-empty-string
     */
    public function charset(): ?string
    {
        return $this->charset;
    }

    /**
     * @return ?non-empty-string
     */
    public function collation(): ?string
    {
        return $this->collation;
    }

    /**
     * @return ?non-empty-string
     */
    public function comment(): ?string
    {
        return $this->comment;
    }
}
