<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals;

use Countable;
use Iterator;
use IteratorAggregate;

/**
 * @template T
 * @implements IteratorAggregate<int, T>
 * @internal
 */
abstract class Collection implements Countable, IteratorAggregate
{
    /**
     * @var array<T>
     */
    protected array $items;

    public function count(): int
    {
        return count($this->items);
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
