<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedIndex;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use ReflectionClass;

/**
 * @internal
 */
final class IndexesResolver
{
    /**
     * @param list<Index> $indexes
     *
     * @return list<ResolvedIndex>
     * @throws MappingException
     */
    public static function resolve(
        ReflectionClass $class,
        array $indexes,
    ): array {
        $resolvedIndexes = [];

        foreach (array_values($indexes) as $i => $index) {
            $resolvedIndexes[] = self::resolveIndex($class, $index, $i + 1);
        }

        return $resolvedIndexes;
    }

    /**
     * @throws MappingException
     */
    private static function resolveIndex(
        ReflectionClass $class,
        Index $index,
        int $indexNumber,
    ): ResolvedIndex {
        $indexName = $index->name() ?: (string) $indexNumber;

        $fields = self::resolveFields($class, $indexName, $index->fields());
        $columns = self::resolveColumns($class, $indexName, $index->columns());
        $flags = self::resolveFlags($class, $indexName, $index->flags());
        $options = self::resolveOptions($class, $indexName, $index->options());

        if (($fields && $columns) || (!$fields && !$columns)) {
            throw MappingException::invalidIndexConfiguration(
                $class->name,
                $indexName,
            );
        }

        return new ResolvedIndex(
            fields: $fields,
            columns: $columns,
            name: $index->name() ?: null,
            flags: $flags,
            options: $options,
        );
    }

    /**
     * @throws MappingException
     * @return ?non-empty-list<non-empty-string>
     */
    private static function resolveFields(
        ReflectionClass $class,
        string $indexName,
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
                throw MappingException::invalidIndexField(
                    $class->name,
                    $indexName,
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
        string $indexName,
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
                throw MappingException::invalidIndexColumn(
                    $class->name,
                    $indexName,
                    $column,
                );
            }
        }

        return $validColumns;
    }

    /**
     * @throws MappingException
     * @return ?non-empty-list<non-empty-string>
     */
    private static function resolveFlags(
        ReflectionClass $class,
        string $indexName,
        ?array $flags,
    ): ?array {
        if (!$flags) {
            return null;
        }

        $validFlags = [];

        foreach ($flags as $flag) {
            if (is_string($flag) && $flag !== '') {
                $validFlags[] = $flag;
            } else {
                throw MappingException::invalidIndexFlag(
                    $class->name,
                    $indexName,
                    $flag,
                );
            }
        }

        return $validFlags;
    }

    /**
     * @throws MappingException
     * @return ?non-empty-array<non-empty-string,mixed>
     */
    private static function resolveOptions(
        ReflectionClass $class,
        string $indexName,
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
                throw MappingException::invalidIndexOption(
                    $class->name,
                    $indexName,
                    $key,
                );
            }
        }

        return $validOptions;
    }
}
