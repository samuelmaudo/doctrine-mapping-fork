<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Enums;

/**
 * The mode to fetch associations.
 *
 * @property-read value-of<Fetch::VALUES> $value
 *
 * TODO: convert to a backed enum when PHP 8.1 is the minimum version
 */
final class Fetch
{
    /** @use BackedEnum<string> */
    use BackedEnum;

    /**
     * The association will be fetched when it is first accessed.
     */
    public const Lazy = 'LAZY';

    /**
     * The association will be fetched when the owner of the
     * association is fetched.
     */
    public const Eager = 'EAGER';

    /**
     * The association will be fetched when it is first accessed and
     * commands such as `Collection::count()`, `Collection::slice()`
     * will be issued directly against the database if the collection
     * is not yet initialized.
     */
    public const ExtraLazy = 'EXTRA_LAZY';

    private const VALUES = [
        self::Lazy,
        self::Eager,
        self::ExtraLazy,
    ];

    /**
     * @return int<2,4>
     *
     * @internal
     */
    public function internalValue(): int
    {
        return match ($this->value) {
            self::Lazy => 2,
            self::Eager => 3,
            self::ExtraLazy => 4,
        };
    }
}
