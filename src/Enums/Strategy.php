<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Enums;

/**
 * The strategy to automatically generate IDs.
 *
 * @property-read value-of<Strategy::VALUES> $value
 *
 * TODO: convert to a backed enum when PHP 8.1 is the minimum version
 */
final class Strategy
{
    /** @use BackedEnum<string> */
    use BackedEnum;

    /**
     * The ID generation will depend on what the used platform prefers.
     * Offers full portability.
     */
    public const Auto = 'AUTO';

    /**
     * A separate sequence object will be used to generate the ID.
     * Platforms that do not have native sequence support may emulate
     * it. Full portability is currently not guaranteed.
     */
    public const Sequence = 'SEQUENCE';

    /**
     * An identity column is used for ID generation. The database will
     * fill in the identity column on insertion. Platforms that do not
     * support native identity columns may emulate them. Full
     * portability is currently not guaranteed.
     */
    public const Identity = 'IDENTITY';

    /**
     * The class does not have a generated ID. That means the class
     * must have a natural, manually assigned ID.
     */
    public const None = 'NONE';

    /**
     * The customer will use its own ID generator that supposedly
     * works.
     */
    public const Custom = 'CUSTOM';

    private const VALUES = [
        self::Auto,
        self::Sequence,
        self::Identity,
        self::None,
        self::Custom,
    ];

    /**
     * @return int<1, 7>
     *
     * @internal
     */
    public function internalValue(): int
    {
        return match ($this->value) {
            self::Auto => 1,
            self::Sequence => 2,
            self::Identity => 4,
            self::None => 5,
            self::Custom => 7,
        };
    }
}
