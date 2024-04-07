<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Column;

use Hereldar\DoctrineMapping\Tests\Column\Comment\DefinedComment;
use Hereldar\DoctrineMapping\Tests\Column\Comment\EmptyComment;
use Hereldar\DoctrineMapping\Tests\Column\Comment\UndefinedComment;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class ColumnCommentTest extends TestCase
{
    public function testDefinedComment(): void
    {
        $metadata = $this->loadClassMetadata(DefinedComment::class);

        self::assertSame('custom comment', $metadata->fieldMappings['field']['options']['comment']);
    }

    public function testUndefinedComment(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedComment::class);

        self::assertNull($metadata->fieldMappings['field']['options']['comment']);
    }

    public function testEmptyComment(): void
    {
        $metadata = $this->loadClassMetadata(EmptyComment::class);

        self::assertNull($metadata->fieldMappings['field']['options']['comment']);
    }
}
