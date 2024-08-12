<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Interfaces\EntityLike;
use Hereldar\DoctrineMapping\Interfaces\FieldLike;
use Hereldar\DoctrineMapping\Internals\Resolvers\ClassResolver;
use ReflectionClass;

final class Embeddable implements EntityLike
{
    /**
     * @phpstan-param ReflectionClass<object> $class
     */
    private function __construct(
        private readonly ReflectionClass $class,
        private readonly Fields $fields,
        private readonly Embeddables $embeddedEmbeddables,
    ) {}

    /**
     * @param class-string|ReflectionClass<object> $class
     *
     * @throws DoctrineMappingException
     */
    public static function of(
        string|ReflectionClass $class,
    ): self {
        if (\is_string($class)) {
            $class = ClassResolver::resolve($class);
        }

        return new self(
            $class,
            Fields::empty(),
            Embeddables::empty(),
        );
    }

    /**
     * @throws DoctrineMappingException
     */
    public function withFields(
        FieldLike ...$fields,
    ): self {
        $fieldCollection = Fields::of($this, ...$fields);

        return new self(
            $this->class,
            $fieldCollection,
            Embeddables::fromFields($fieldCollection),
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

    public function fields(): Fields
    {
        return $this->fields;
    }

    public function embeddedEmbeddables(): Embeddables
    {
        return $this->embeddedEmbeddables;
    }
}
