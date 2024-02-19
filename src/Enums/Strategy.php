<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Enums;

/**
 * The strategy to automatically generate IDs.
 *
 * TODO: convert to a backed enum when PHP 8.1 is the minimum version
 */
final class Strategy
{
    /**
     * The ID generation will depend on what the used platform prefers.
     * Offers full portability.
     */
    public const Auto = 1;

    /**
     * A separate sequence object will be used to generate the ID.
     * Platforms that do not have native sequence support may emulate
     * it. Full portability is currently not guaranteed.
     */
    public const Sequence = 2;

    /**
     * An identity column is used for ID generation. The database will
     * fill in the identity column on insertion. Platforms that do not
     * support native identity columns may emulate them. Full
     * portability is currently not guaranteed.
     */
    public const Identity = 4;

    /**
     * The class does not have a generated ID. That means the class
     * must have a natural, manually assigned ID.
     */
    public const None = 5;

    /**
     * The customer will use its own ID generator that supposedly
     * works.
     */
    public const Custom = 7;

    private function __construct(
        private int $value,
    ) {}

    /**
     * @throws \Error
     */
    public static function from(int|string $value): self
    {
        return match ($value) {
            1, 'AUTO' => new self(self::Auto),
            2, 'SEQUENCE' => new self(self::Sequence),
            4, 'IDENTITY' => new self(self::Identity),
            5, 'NONE' => new self(self::None),
            7, 'CUSTOM' => new self(self::Custom),
        };
    }

    /**
     * @return int<1, 7>
     */
    public function value(): int
    {
        return $this->value;
    }
}
