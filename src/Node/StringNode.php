<?php

declare(strict_types = 1);

namespace SortedLinkedList\Node;

/**
 * @extends AbstractNode<string>
 */
class StringNode extends AbstractNode
{

    /**
     * @var string
     */
    public $data;

    /**
     * @var AbstractNode<string>|null
     */
    public ?AbstractNode $next;

    public function __construct(string $data)
    {
        parent::__construct($data);
    }

}
