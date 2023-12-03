<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Drivers;

use Doctrine\Persistence\Mapping\Driver\DefaultFileLocator;
use Doctrine\Persistence\Mapping\Driver\FileLocator;

final class PhpDriver extends AbstractPhpDriver
{
    public const DEFAULT_FILE_EXTENSION = '.dcm.php';

    /**
     * @param string|array<int, string>|FileLocator $locator A `FileLocator` or one/multiple paths where mapping files can be found.
     * @param string $fileExtension The file extension of mapping files, usually prefixed with a dot.
     */
    public function __construct(
        string|array|FileLocator $locator,
        string $fileExtension = self::DEFAULT_FILE_EXTENSION,
    ) {
        if ($locator instanceof FileLocator) {
            $this->locator = $locator;
        } else {
            $this->locator = new DefaultFileLocator((array) $locator, $fileExtension);
        }
    }
}
