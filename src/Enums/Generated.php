<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Enums;

use Doctrine\ORM\Mapping\MappingException as OrmMappingException;

/**
 * TODO: convert to a backed enum when PHP 8.1 is the minimum version
 */
final class Generated
{
    public const Never = 0;
    public const Insert = 1;
    public const Always = 2;

    private function __construct(
        private int $value,
    ) {}

    public static function from(int|string $value): self
    {
        return match ($value) {
            0, 'NEVER' => new self(self::Never),
            1, 'INSERT' => new self(self::Insert),
            2, 'ALWAYS' => new self(self::Always),
            default => throw OrmMappingException::invalidGeneratedMode($value),
        };
    }

    public static function tryFrom(int|string|null $value): ?self
    {
        if (null === $value) {
            return null;
        }
        return self::from($value);
    }

    /**
     * @return int<0, 2>
     */
    public function value(): int
    {
        return $this->value;
    }
}
