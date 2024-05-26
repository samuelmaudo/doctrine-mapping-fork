<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Internals\Exceptions\FalseTypeError;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\Resolvers\ClassResolver;
use ReflectionClass;

use function Hereldar\DoctrineMapping\Internals\to_snake_case;

/**
 * @psalm-immutable
 */
final class Embedded implements FieldLike
{
    /**
     * @param non-empty-string $property
     * @param non-empty-string|false $columnPrefix
     * @param list<FieldLike> $fields
     *
     * @internal
     */
    public function __construct(
        private string $property,
        private ?ReflectionClass $class,
        private string|bool $columnPrefix,
        private array $fields,
    ) {}

    /**
     * @param non-empty-string $property
     * @param ?class-string $class
     * @param non-empty-string|false|null $columnPrefix
     *
     * @throws DoctrineMappingException
     */
    public static function of(
        string $property,
        ?string $class = null,
        string|bool|null $columnPrefix = null,
    ): self|IncompleteEmbedded {
        // TODO: remove when PHP 8.1 is the minimum version
        if ($columnPrefix === true) {
            throw new FalseTypeError('Embedded::of()', 3, '$columnPrefix');
        }

        if (!$property) {
            throw MappingException::emptyPropertyName();
        }

        $class = ClassResolver::resolveNullable($class);

        if (null === $columnPrefix) {
            $columnPrefix = to_snake_case($property).'_';
        } elseif ('' === $columnPrefix) {
            $columnPrefix = false;
        }

        if (null === $class) {
            return new IncompleteEmbedded($property, $columnPrefix, []);
        }

        return new self($property, $class, $columnPrefix, []);
    }

    /**
     * @param non-empty-list<FieldLike> $fields
     */
    public function withFields(
        FieldLike ...$fields,
    ): self {
        return new self(
            $this->property,
            $this->class,
            $this->columnPrefix,
            $fields,
        );
    }

    /**
     * @return non-empty-string
     */
    public function property(): string
    {
        return $this->property;
    }

    public function class(): ?ReflectionClass
    {
        return $this->class;
    }

    public function className(): string
    {
        return $this->class->name;
    }

    public function classSortName(): string
    {
        return $this->class->getShortName();
    }

    /**
     * @return non-empty-string|false
     */
    public function columnPrefix(): string|bool
    {
        return $this->columnPrefix;
    }

    /**
     * @return list<FieldLike>
     */
    public function fields(): array
    {
        return $this->fields;
    }
}
