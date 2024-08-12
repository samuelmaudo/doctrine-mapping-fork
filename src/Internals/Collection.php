<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals;

use Countable;
use Iterator;
use IteratorAggregate;

/**
 * @template T
 *
 * @implements IteratorAggregate<int, T>
 *
 * @internal
 */
abstract class Collection implements Countable, IteratorAggregate
{
    /**
     * @param array<T> $items
     */
    protected function __construct(
        protected readonly array $items,
    ) {}

    public function count(): int
    {
        return \count($this->items);
    }

    /**
     * @return Iterator<int, T>
     */
    public function getIterator(): Iterator
    {
        foreach ($this->items as $item) {
            yield $item;
        }
    }
}
