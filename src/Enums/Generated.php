<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Enums;

use Doctrine\ORM\Mapping\ClassMetadataInfo;

/**
 * TODO: convert to a backed enum when PHP 8.1 is the minimum version
 */
final class Generated
{
    public const Never = ClassMetadataInfo::GENERATED_NEVER;
    public const Insert = ClassMetadataInfo::GENERATED_INSERT;
    public const Always = ClassMetadataInfo::GENERATED_ALWAYS;

    private const CASES = [
        self::Never,
        self::Insert,
        self::Always,
    ];

    public function cases(): array
    {
        return self::CASES;
    }

    public function has(int $value): bool
    {
        return in_array($value, self::CASES, true);
    }
}
