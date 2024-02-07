<?php

declare(strict_types = 1);

namespace SortedLinkedList\List;

use SortedLinkedList\List\Exception\InvalidNodeTypePassedException;
use SortedLinkedList\Node\IntegerNode;

/**
 * @extends AbstractSortedLinkedList<int>
 */
class IntegerSortedLinkedList extends AbstractSortedLinkedList
{

    /**
     * @param int $data
     */
    public function createNode($data): IntegerNode
    {
        return new IntegerNode($data);
    }

    public function checkDataType(mixed $data): void
    {
        if (is_int($data) === false) {
            throw new InvalidNodeTypePassedException(
                'int',
                gettype($data),
            );
        }
    }

}
