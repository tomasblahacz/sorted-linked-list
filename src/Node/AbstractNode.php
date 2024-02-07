<?php

declare(strict_types = 1);

namespace SortedLinkedList\Node;

/**
 * @template T
 */
abstract class AbstractNode
{

    /**
     * @var T
     */
    public $data;

    /**
     * @var AbstractNode<T>|null
     */
    public ?AbstractNode $next;

    /**
     * @param T $data
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->next = null;
    }

}
