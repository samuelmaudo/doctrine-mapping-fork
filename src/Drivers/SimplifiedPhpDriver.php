<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Drivers;

use Doctrine\Persistence\Mapping\Driver\SymfonyFileLocator;

final class SimplifiedPhpDriver extends AbstractPhpDriver
{
    public const DEFAULT_FILE_EXTENSION = '.orm.php';

    /**
     * @param array<string, string> $prefixes a map of mapping directory path to namespace prefix used to expand class shortnames
     * @param string $fileExtension the file extension of mapping documents (usually prefixed with a dot)
     */
    public function __construct(
        array $prefixes,
        string $fileExtension = self::DEFAULT_FILE_EXTENSION,
    ) {
        $this->locator = new SymfonyFileLocator($prefixes, $fileExtension);
    }
}
