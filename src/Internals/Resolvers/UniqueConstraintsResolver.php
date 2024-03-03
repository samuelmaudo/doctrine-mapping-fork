<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Hereldar\DoctrineMapping\Internals\Elements\ResolvedUniqueConstraint;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use Hereldar\DoctrineMapping\UniqueConstraint;
use ReflectionClass;

/**
 * @internal
 */
final class UniqueConstraintsResolver
{
    /**
     * @param list<UniqueConstraint> $constraints
     *
     * @return list<ResolvedUniqueConstraint>
     * @throws MappingException
     */
    public static function resolve(
        ReflectionClass $class,
        array $constraints,
    ): array {
        $resolvedConstraints = [];

        foreach (array_values($constraints) as $i => $constraint) {
            $resolvedConstraints[] = self::resolveIndex($class, $constraint, $i + 1);
        }

        return $resolvedConstraints;
    }

    /**
     * @throws MappingException
     */
    private static function resolveIndex(
        ReflectionClass $class,
        UniqueConstraint $constraint,
        int $constraintNumber,
    ): ResolvedUniqueConstraint {
        $constraintName = $constraint->name() ?: (string) $constraintNumber;

        $fields = self::resolveFields($class, $constraintName, $constraint->fields());
        $columns = self::resolveColumns($class, $constraintName, $constraint->columns());
        $options = self::resolveOptions($class, $constraintName, $constraint->options());

        if (($fields && $columns) || (!$fields && !$columns)) {
            throw MappingException::invalidUniqueConstraintConfiguration(
                $class->name,
                $constraintName,
            );
        }

        return new ResolvedUniqueConstraint(
            fields: $fields,
            columns: $columns,
            name: $constraint->name() ?: null,
            options: $options,
        );
    }

    /**
     * @throws MappingException
     * @return ?non-empty-list<non-empty-string>
     */
    private static function resolveFields(
        ReflectionClass $class,
        string $constraintName,
        ?array $fields,
    ): ?array {
        if (!$fields) {
            return null;
        }

        $validFields = [];

        foreach ($fields as $field) {
            if (is_string($field) && $field !== '') {
                $validFields[] = $field;
            } else {
                throw MappingException::invalidUniqueConstraintField(
                    $class->name,
                    $constraintName,
                    $field,
                );
            }
        }

        return $validFields;
    }

    /**
     * @throws MappingException
     * @return ?non-empty-list<non-empty-string>
     */
    private static function resolveColumns(
        ReflectionClass $class,
        string $constraintName,
        ?array $columns,
    ): ?array {
        if (!$columns) {
            return null;
        }

        $validColumns = [];

        foreach ($columns as $column) {
            if (is_string($column) && $column !== '') {
                $validColumns[] = $column;
            } else {
                throw MappingException::invalidUniqueConstraintColumn(
                    $class->name,
                    $constraintName,
                    $column,
                );
            }
        }

        return $validColumns;
    }

    /**
     * @throws MappingException
     * @return ?non-empty-array<non-empty-string,mixed>
     */
    private static function resolveOptions(
        ReflectionClass $class,
        string $constraintName,
        ?array $options,
    ): ?array {
        if (!$options) {
            return null;
        }

        $validOptions = [];

        foreach ($options as $key => $value) {
            if (is_string($key) && $key !== '') {
                $validOptions[$key] = $value;
            } else {
                throw MappingException::invalidUniqueConstraintOption(
                    $class->name,
                    $constraintName,
                    $key,
                );
            }
        }

        return $validOptions;
    }
}
