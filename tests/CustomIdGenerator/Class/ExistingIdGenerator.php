<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Id\AbstractIdGenerator;

final class ExistingIdGenerator extends AbstractIdGenerator
{
    /**
     * @param object|null $entity
     */
    public function generateId(EntityManagerInterface $em, $entity): array
    {
        return [];
    }
}
