<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Interfaces\FieldLike;
use Hereldar\DoctrineMapping\Internals\Exceptions\FalseTypeError;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\Resolvers\ClassResolver;
use ReflectionClass;

final class Embedded extends AbstractEmbedded
{
    /**
     * @param non-empty-string $property
     * @phpstan-param ReflectionClass<object> $class
     * @param non-empty-string|false|null $columnPrefix
     * @param list<FieldLike> $fields
     *
     * @internal
     */
    public function __construct(
        protected readonly string $property,
        private readonly ReflectionClass $class,
        protected readonly string|bool|null $columnPrefix,
        protected readonly array $fields,
    ) {}

    /**
     * @param non-empty-string $property
     * @param class-string|null $class
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
        if (true === $columnPrefix) {
            throw new FalseTypeError('Embedded::of()', 3, '$columnPrefix');
        }

        if (!$property) {
            throw MappingException::emptyPropertyName();
        }

        /** @var ReflectionClass<object>|null $class */
        $class = ClassResolver::resolveNullable($class);

        if ('' === $columnPrefix) {
            $columnPrefix = false;
        }

        if (null === $class) {
            return new IncompleteEmbedded($property, $columnPrefix, []);
        }

        return new self($property, $class, $columnPrefix, []);
    }

    public function withFields(
        FieldLike ...$fields,
    ): self {
        return new self(
            $this->property,
            $this->class,
            $this->columnPrefix,
            \array_values($fields),
        );
    }

    /**
     * @return ReflectionClass<object>
     */
    public function class(): ReflectionClass
    {
        return $this->class;
    }

    /**
     * @return class-string
     */
    public function className(): string
    {
        return $this->class->name;
    }

    /**
     * @return non-empty-string
     */
    public function classShortName(): string
    {
        /** @var non-empty-string */
        return $this->class->getShortName();
    }
}
