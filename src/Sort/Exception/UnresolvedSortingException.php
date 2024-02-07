<?php

declare(strict_types = 1);

namespace SortedLinkedList\Sort\Exception;

use Exception;
use SortedLinkedList\Sort\SortedLinkedListSortEnum;

class UnresolvedSortingException extends Exception
{

    public function __construct(SortedLinkedListSortEnum $sort, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct(sprintf('Unresolved sorting type: %s', $sort->value), $code, $previous);
    }

}
