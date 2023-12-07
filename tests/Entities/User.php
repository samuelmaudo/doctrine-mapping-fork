<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Entities;

/**
 * @internal
 */
final class User
{
    public function __construct(
        public UserId $id,
        public UserEmail $email,
        public ?UserName $name,
    ) {}
}
