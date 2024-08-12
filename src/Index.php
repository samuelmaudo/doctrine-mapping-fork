<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;

final class Index
{
    /**
     * @param non-empty-list<non-empty-string>|null $fields
     * @param non-empty-list<non-empty-string>|null $columns
     * @param non-empty-string|null $name
     * @param non-empty-list<non-empty-string>|null $flags
     * @param non-empty-array<non-empty-string,mixed>|null $options
     */
    private function __construct(
        private readonly ?array $fields,
        private readonly ?array $columns,
        private readonly ?string $name,
        private readonly ?array $flags,
        private readonly ?array $options,
    ) {}

    /**
     * @param non-empty-list<non-empty-string>|non-empty-string|null $fields
     * @param non-empty-list<non-empty-string>|non-empty-string|null $columns
     * @param non-empty-string|null $name name of the index
     * @param non-empty-list<non-empty-string>|non-empty-string|null $flags
     * @param non-empty-array<non-empty-string,mixed>|null $options platform specific options
     *
     * @throws DoctrineMappingException
     */
    public static function of(
        array|string|null $fields = null,
        array|string|null $columns = null,
        ?string $name = null,
        array|string|null $flags = null,
        ?array $options = null,
    ): self {
        if ('' === $name) {
            $name = null;
        }

        $fields = self::sanitizeFields($fields, $name);
        $columns = self::sanitizeColumns($columns, $name);
        $flags = self::sanitizeFlags($flags, $name);
        $options = self::sanitizeOptions($options, $name);

        if (($fields && $columns) || (!$fields && !$columns)) {
            throw MappingException::invalidIndexConfiguration($name);
        }

        return new self(
            $fields,
            $columns,
            $name,
            $flags,
            $options,
        );
    }

    /**
     * @return non-empty-list<non-empty-string>|null
     */
    public function fields(): ?array
    {
        return $this->fields;
    }

    /**
     * @return non-empty-list<non-empty-string>|null
     */
    public function columns(): ?array
    {
        return $this->columns;
    }

    /**
     * @return non-empty-string|null
     */
    public function name(): ?string
    {
        return $this->name;
    }

    /**
     * @return non-empty-list<non-empty-string>|null
     */
    public function flags(): ?array
    {
        return $this->flags;
    }

    /**
     * @return non-empty-array<non-empty-string,mixed>|null
     */
    public function options(): ?array
    {
        return $this->options;
    }

    /**
     * @param non-empty-list<non-empty-string>|null $fields
     * @param non-empty-string|null $constraintName
     *
     * @return non-empty-list<non-empty-string>|null
     *
     * @throws DoctrineMappingException
     */
    private static function sanitizeFields(
        array|string|null $fields,
        ?string $constraintName,
    ): ?array {
        if (!$fields) {
            return null;
        }

        if (\is_string($fields)) {
            return [$fields];
        }

        $validFields = [];

        foreach ($fields as $field) {
            if (\is_string($field) && '' !== $field) {
                $validFields[] = $field;
            } else {
                throw MappingException::invalidIndexField(
                    $constraintName,
                    $field,
                );
            }
        }

        return $validFields;
    }

    /**
     * @param non-empty-list<non-empty-string>|null $columns
     * @param non-empty-string|null $constraintName
     *
     * @return non-empty-list<non-empty-string>|null
     *
     * @throws DoctrineMappingException
     */
    private static function sanitizeColumns(
        array|string|null $columns,
        ?string $constraintName,
    ): ?array {
        if (!$columns) {
            return null;
        }

        if (\is_string($columns)) {
            return [$columns];
        }

        $validColumns = [];

        foreach ($columns as $column) {
            if (\is_string($column) && '' !== $column) {
                $validColumns[] = $column;
            } else {
                throw MappingException::invalidIndexColumn(
                    $constraintName,
                    $column,
                );
            }
        }

        return $validColumns;
    }

    /**
     * @param non-empty-list<non-empty-string>|null $flags
     * @param non-empty-string|null $constraintName
     *
     * @return non-empty-list<non-empty-string>|null
     *
     * @throws DoctrineMappingException
     */
    private static function sanitizeFlags(
        array|string|null $flags,
        ?string $constraintName,
    ): ?array {
        if (!$flags) {
            return null;
        }

        if (\is_string($flags)) {
            return [$flags];
        }

        $validFlags = [];

        foreach ($flags as $flag) {
            if (\is_string($flag) && '' !== $flag) {
                $validFlags[] = $flag;
            } else {
                throw MappingException::invalidIndexFlag(
                    $constraintName,
                    $flag,
                );
            }
        }

        return $validFlags;
    }

    /**
     * @param non-empty-array<non-empty-string,mixed>|null $options
     * @param non-empty-string|null $constraintName
     *
     * @return non-empty-array<non-empty-string,mixed>|null
     *
     * @throws DoctrineMappingException
     */
    private static function sanitizeOptions(
        ?array $options,
        ?string $constraintName,
    ): ?array {
        if (!$options) {
            return null;
        }

        foreach ($options as $key => $value) {
            if (!\is_string($key) || '' === $key) {
                throw MappingException::invalidIndexOption(
                    $constraintName,
                    $key,
                );
            }
        }

        return $options;
    }
}
