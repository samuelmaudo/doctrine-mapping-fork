<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne\TargetEntity;

final class UndefinedTargetEntity
{
    public function __construct(
        public ExistingAssociation $association,
    ) {}
}
