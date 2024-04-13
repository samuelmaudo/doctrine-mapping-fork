<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;

/**
 * @psalm-immutable
 */
final class SequenceGenerator
{
    /**
     * @param ?non-empty-string $sequenceName
     * @param positive-int $allocationSize
     * @param positive-int $initialValue
     */
    private function __construct(
        private ?string $sequenceName,
        private int $allocationSize,
        private int $initialValue,
    ) {}

    /**
     * @param ?non-empty-string $sequenceName
     * @param positive-int $allocationSize
     * @param positive-int $initialValue
     *
     * @throws DoctrineMappingException
     */
    public static function of(
        AbstractId $field,
        ?string $sequenceName,
        int $allocationSize = 1,
        int $initialValue = 1,
    ): self {
        if ($sequenceName === '') {
            throw MappingException::emptySequenceName(
                $field->property(),
            );
        }

        if ($allocationSize < 1) {
            throw MappingException::nonPositiveAllocationSize(
                $field->property(),
            );
        }

        if ($initialValue < 1) {
            throw MappingException::nonPositiveInitialValue(
                $field->property(),
            );
        }

        return new self(
            $sequenceName,
            $allocationSize,
            $initialValue,
        );
    }

    /**
     * @return ?non-empty-string
     */
    public function sequenceName(): ?string
    {
        return $this->sequenceName;
    }

    /**
     * @return positive-int
     */
    public function allocationSize(): int
    {
        return $this->allocationSize;
    }

    /**
     * @return positive-int
     */
    public function initialValue(): int
    {
        return $this->initialValue;
    }
}
