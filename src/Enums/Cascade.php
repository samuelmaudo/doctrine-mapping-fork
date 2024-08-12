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
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/working-with-associations.html#transitive-persistence-cascade-operations
 */
enum Cascade: string
{
    /**
     * Apply to the associated entities all the operations that can be
     * cascaded automatically.
     */
    case All = 'all';

    /**
     * Remove the associated entities when their owner is removed.
     */
    case Remove = 'remove';

    /**
     * Persist the associated entities when their owner is
     * persisted.
     */
    case Persist = 'persist';

    /**
     * Fetch the associated entities when their owner is refreshed.
     */
    case Refresh = 'refresh';

    /**
     * Detach the associated entities when their owner is detached.
     */
    case Detach = 'detach';
}
