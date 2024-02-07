<?php

declare(strict_types = 1);

namespace SortedLinkedList\List\Exception;

use Exception;

class CouldNotRemoveException extends Exception
{

    public function __construct(int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct('Could not remove the node, the list is empty', $code, $previous);
    }

}
