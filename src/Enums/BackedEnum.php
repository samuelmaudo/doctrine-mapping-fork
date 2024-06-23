<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Enums;

use Error;
use ValueError;

/**
 * @template T of int|string
 *
 * @property-read T $value
 *
 * @internal
 */
trait BackedEnum
{
    /** @var array<self> */
    private static array $cases = [];

    private function __construct(
        private int|string $backingValue,
    ) {}

    public function __get(string $name)
    {
        return match ($name) {
            'value' => $this->backingValue,
            default => throw new Error("Attempt to read undefined property {$name}"),
        };
    }

    public function __set(string $name, $value): void
    {
        match ($name) {
            'value' => throw new Error('Attempt to write read-only property value'),
            default => throw new Error("Attempt to write undefined property {$name}"),
        };
    }

    public function __isset(string $name): bool
    {
        return match ($name) {
            'value' => true,
            default => false,
        };
    }

    /**
     * @return list<self>
     */
    public static function cases(): array
    {
        $list = [];

        foreach (self::VALUES as $value) {
            $list[] = self::$cases[$value] ??= new self($value);
        }

        return $list;
    }

    /**
     * @return list<T>
     */
    public static function values(): array
    {
        return self::VALUES;
    }

    /**
     * @throws ValueError
     */
    public static function from(int|string $value): static
    {
        if (!\in_array($value, self::VALUES, true)) {
            throw new ValueError(\sprintf('%s is not a valid backing value for enum %s', \var_export($value, true), self::class));
        }

        return self::$cases[$value] ??= new self($value);
    }

    public static function tryFrom(int|string $value): ?static
    {
        if (!\in_array($value, self::VALUES, true)) {
            return null;
        }

        return self::$cases[$value] ??= new self($value);
    }
}
