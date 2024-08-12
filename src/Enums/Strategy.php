<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Enums;

/**
 * The strategy to automatically generate IDs.
 */
enum Strategy: string
{
    /**
     * The ID generation will depend on what the used platform prefers.
     * Offers full portability.
     */
    case Auto = 'AUTO';

    /**
     * A separate sequence object will be used to generate the ID.
     * Platforms that do not have native sequence support may emulate
     * it. Full portability is currently not guaranteed.
     */
    case Sequence = 'SEQUENCE';

    /**
     * An identity column is used for ID generation. The database will
     * fill in the identity column on insertion. Platforms that do not
     * support native identity columns may emulate them. Full
     * portability is currently not guaranteed.
     */
    case Identity = 'IDENTITY';

    /**
     * The class does not have a generated ID. That means the class
     * must have a natural, manually assigned ID.
     */
    case None = 'NONE';

    /**
     * The customer will use its own ID generator that supposedly
     * works.
     */
    case Custom = 'CUSTOM';

    /**
     * @return 1|2|4|5|7
     *
     * @internal
     */
    public function internalValue(): int
    {
        return match ($this) {
            self::Auto => 1,
            self::Sequence => 2,
            self::Identity => 4,
            self::None => 5,
            self::Custom => 7,
        };
    }
}
