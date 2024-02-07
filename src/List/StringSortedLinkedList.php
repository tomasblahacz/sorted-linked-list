<?php

declare(strict_types = 1);

namespace SortedLinkedList\List;

use SortedLinkedList\Node\StringNode;

/**
 * @extends AbstractSortedLinkedList<string>
 */
class StringSortedLinkedList extends AbstractSortedLinkedList
{

    /**
     * @param string $data
     */
    public function createNode($data): StringNode
    {
        return new StringNode($data);
    }

}
