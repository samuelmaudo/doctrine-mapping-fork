<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Enums;

/**
 * The operations that can be configured to be automatically cascaded
 * to the associated entities.
 *
 * Take into account that cascade operations are performed in memory.
 *
 * That means collections and related entities are fetched into memory
 * (even if they are marked as lazy) when the cascade operation is
 * about to be performed.
 *
 * This allows entity lifecycle events to be performed for each of
 * these operations.
 *
 * However, pulling object graphs into memory on cascade can cause
 * considerable performance overhead, especially when the cascaded
 * collections are large.
 *
 * Make sure to weigh the benefits and downsides of each cascade
 * operation that you define.
 *
 * @property-read value-of<Cascade::VALUES> $value
 *
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/working-with-associations.html#transitive-persistence-cascade-operations
 *
 * TODO: convert to a backed enum when PHP 8.1 is the minimum version
 */
final class Cascade
{
    /** @use BackedEnum<string> */
    use BackedEnum;

    /**
     * Apply to the associated entities all the operations that can be
     * cascaded automatically.
     */
    public const All = 'all';

    /**
     * Remove the associated entities when their owner is removed.
     */
    public const Remove = 'remove';

    /**
     * Persist the associated entities when their owner is persisted.
     */
    public const Persist = 'persist';

    /**
     * Fetch the associated entities when their owner is refreshed.
     */
    public const Refresh = 'refresh';

    /**
     * Detach the associated entities when their owner is detached.
     */
    public const Detach = 'detach';

    private const VALUES = [
        self::All,
        self::Remove,
        self::Persist,
        self::Refresh,
        self::Detach,
    ];
}
