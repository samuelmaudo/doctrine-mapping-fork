<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;

final class Table
{
    /**
     * @param non-empty-string|null $name
     * @param non-empty-string|null $schema
     * @param non-empty-array<non-empty-string,mixed>|null $options
     */
    private function __construct(
        private readonly ?string $name,
        private readonly ?string $schema,
        private readonly ?array $options,
    ) {}

    /**
     * @param non-empty-string|null $name name of the table
     * @param non-empty-string|null $schema name of the schema that contains the table
     * @param non-empty-array<non-empty-string,mixed>|null $options platform specific options
     *
     * @throws DoctrineMappingException
     */
    public static function of(
        AbstractEntity $entity,
        ?string $name = null,
        ?string $schema = null,
        ?array $options = null,
    ): self {
        if ('' === $name) {
            throw MappingException::emptyTableName($entity->className());
        }

        if ('' === $schema) {
            throw MappingException::emptySchemaName($entity->className());
        }

        if (null !== $options) {
            foreach ($options as $key => $value) {
                if (!\is_string($key) || '' === $key) {
                    throw MappingException::invalidTableOption(
                        $entity->className(),
                        $key,
                    );
                }
            }
        }

        return new self(
            $name,
            $schema,
            $options,
        );
    }

    public static function empty(): self
    {
        return new self(
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
    public function schema(): ?string
    {
        return $this->schema;
    }

    /**
     * @return non-empty-array<non-empty-string,mixed>|null
     */
    public function options(): ?array
    {
        return $this->options;
    }
}
