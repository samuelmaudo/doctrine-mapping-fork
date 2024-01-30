<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Hereldar\DoctrineMapping\Tests\Field\Comment\DefinedComment;
use Hereldar\DoctrineMapping\Tests\Field\Comment\EmptyComment;
use Hereldar\DoctrineMapping\Tests\Field\Comment\UndefinedComment;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldCommentTest extends TestCase
{
    public function testDefinedComment(): void
    {
        $metadata = $this->loadClassMetadata(DefinedComment::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertArrayHasKey('options', $metadata->fieldMappings['field']);
        self::assertSame('custom comment', $metadata->fieldMappings['field']['options']['comment']);
    }

    public function testUndefinedComment(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedComment::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertArrayHasKey('options', $metadata->fieldMappings['field']);
        self::assertNull($metadata->fieldMappings['field']['options']['comment']);
    }

    public function testEmptyComment(): void
    {
        $metadata = $this->loadClassMetadata(EmptyComment::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertArrayHasKey('options', $metadata->fieldMappings['field']);
        self::assertNull($metadata->fieldMappings['field']['options']['comment']);
    }
}
