<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;

interface IncompleteAssociation extends AssociationLike
{
    /**
     * @param class-string $class
     *
     * @throws DoctrineMappingException
     */
    public function withTargetEntity(string $class): Association;
}
