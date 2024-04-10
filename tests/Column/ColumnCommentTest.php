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

        self::assertFieldOption($metadata, 'field', 'comment', 'custom comment');
    }

    public function testUndefinedComment(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedComment::class);

        self::assertFieldOption($metadata, 'field', 'comment', null);
    }

    public function testEmptyComment(): void
    {
        $metadata = $this->loadClassMetadata(EmptyComment::class);

        self::assertFieldOption($metadata, 'field', 'comment', null);
    }
}
