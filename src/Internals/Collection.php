<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals;

use ArrayIterator;
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
     * @return ArrayIterator<int, T>
     */
    public function getIterator(): Iterator
    {
        return new ArrayIterator($this->items);
    }
}
