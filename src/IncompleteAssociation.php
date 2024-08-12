<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;

abstract class IncompleteAssociation extends AbstractAssociation
{
    /**
     * @param class-string $class
     *
     * @throws DoctrineMappingException
     */
    abstract public function withTargetEntity(string $class): Association;
}
