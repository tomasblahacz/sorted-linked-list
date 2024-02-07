<?php

declare(strict_types = 1);

namespace SortedLinkedList\List\Exception;

use RuntimeException;

class CouldNotAccessCurrentNodeException extends RuntimeException
{

    public function __construct(int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct('Could not access current node, since the List is empty', $code, $previous);
    }

}
