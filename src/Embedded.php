<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Hereldar\DoctrineMapping\Internals\Exceptions\FalseTypeError;

/**
 * @psalm-immutable
 */
final class Embedded
{
    private function __construct(
        private string $property,
        private ?string $class,
        private string|bool|null $columnPrefix,
        private ?array $fields = null,
    ) {}

    /**
     * @param non-empty-string $property
     * @param ?class-string $class
     * @param non-empty-string|false|null $columnPrefix
     */
    public static function of(
        string $property,
        ?string $class = null,
        string|bool|null $columnPrefix = null,
    ): self {
        if ($columnPrefix === true) {
            throw new FalseTypeError('Embedded::of()', 3, '$columnPrefix');
        }

        return new self($property, $class, $columnPrefix);
    }

    /**
     * @param non-empty-list<Field|Embedded> $fields
     */
    public function withFields(
        Field|Embedded ...$fields,
    ): self {
        return new self(
            $this->property,
            $this->class,
            $this->columnPrefix,
            $fields,
        );
    }

    public function property(): string
    {
        return $this->property;
    }

    public function class(): ?string
    {
        return $this->class;
    }

    public function columnPrefix(): string|bool|null
    {
        return $this->columnPrefix;
    }

    public function fields(): ?array
    {
        return $this->fields;
    }
}
