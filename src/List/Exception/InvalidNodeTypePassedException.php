<?php

declare(strict_types = 1);

namespace SortedLinkedList\List\Exception;

use RuntimeException;

class InvalidNodeTypePassedException extends RuntimeException
{

    public function __construct(
        string $expectedDataType,
        string $actualDataType,
        int $code = 0,
        ?\Throwable $previous = null
    )
    {
        parent::__construct(
            sprintf(
                'Expected node data type is %s, but %s was passed',
                $expectedDataType,
                $actualDataType,
            ),
            $code,
            $previous
        );
    }

}
