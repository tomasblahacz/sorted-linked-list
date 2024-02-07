<?php

declare(strict_types = 1);

namespace SortedLinkedList\Node;

/**
 * @extends AbstractNode<int>
 */
class IntegerNode extends AbstractNode
{

    /**
     * @var int
     */
    public $data;

    /**
     * @var AbstractNode<int>|null
     */
    public ?AbstractNode $next;

    public function __construct(int $data)
    {
        parent::__construct($data);
    }

}
