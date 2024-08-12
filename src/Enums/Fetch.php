<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Enums;

/**
 * The mode to fetch associations.
 */
enum Fetch: string
{
    /**
     * The association will be fetched when it is first accessed.
     */
    case Lazy = 'LAZY';

    /**
     * The association will be fetched when the owner of the
     * association is fetched.
     */
    case Eager = 'EAGER';

    /**
     * The association will be fetched when it is first accessed and
     * commands such as `Collection::count()`, `Collection::slice()`
     * will be issued directly against the database if the collection
     * is not yet initialized.
     */
    case ExtraLazy = 'EXTRA_LAZY';

    /**
     * @return int<2,4>
     *
     * @internal
     */
    public function internalValue(): int
    {
        return match ($this) {
            self::Lazy => 2,
            self::Eager => 3,
            self::ExtraLazy => 4,
        };
    }
}
