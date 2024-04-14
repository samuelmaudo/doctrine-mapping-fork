<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Fields;

use Doctrine\DBAL\Types\Types;

/**
 * @psalm-immutable
 */
class BigIntegerField extends IntegerField
{
    public static function defaultType(): string
    {
        return Types::BIGINT;
    }
}
