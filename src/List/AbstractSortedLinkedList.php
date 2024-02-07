<?php

declare(strict_types = 1);

namespace SortedLinkedList\List;

use Exception;
use Generator;
use SortedLinkedList\List\Exception\CouldNotRemoveException;
use SortedLinkedList\Node\AbstractNode;
use SortedLinkedList\Sort\Exception\UnresolvedSortingException;
use SortedLinkedList\Sort\SortedLinkedListSortEnum;

/**
 * @template T
 */
abstract class AbstractSortedLinkedList
{

    /**
     * @var AbstractNode<T>|null
     */
    private ?AbstractNode $head = null;

    private SortedLinkedListSortEnum $sort;

    public function __construct(SortedLinkedListSortEnum $sort)
    {
        $this->sort = $sort;
    }

    /**
     * @param T $data
     */
    public function insert($data): void
    {
        $nodeToAdd = $this->createNode($data);

        if ($this->head === null || $this->shouldBePlacedBefore($nodeToAdd->data, $this->head->data) === true) {
            $nodeToAdd->next = $this->head;
            $this->head = $nodeToAdd;

            return;
        }

        $current = $this->getPositionToAddTo($nodeToAdd);

        $nodeToAdd->next = $current->next;
        $current->next = $nodeToAdd;
    }

    /**
     * @param T $data
     */
    public function remove($data): void
    {
        if ($this->head === null) {
            throw new CouldNotRemoveException();
        }

        if ($this->head->data === $data) {
            $this->head = $this->head->next;
            return;
        }

        $current = $this->head;
        while ($current->next !== null && $current->next->data !== $data) {
            $current = $current->next;
        }

        if ($current->next !== null) {
            $current->next = $current->next->next;
        }
    }

    /**
     * @param T $data
     */
    public function has($data): bool
    {
        $current = $this->head;
        while ($current !== null) {
            if ($current->data === $data) {
                return true;
            }
            $current = $current->next;
        }
        return false;
    }

    /**
     * @return T[]
     */
    public function toArray(): array
    {
        $arrayToOutput = [];
        $current = $this->head;

        while ($current !== null) {
            $arrayToOutput[] = $current->data;
            $current = $current->next;
        }
        return $arrayToOutput;
    }

    public function toGenerator(): Generator
    {
        $current = $this->head;
        while ($current !== null) {
            yield $current->data;
            $current = $current->next;
        }
    }

    /**
     * @param AbstractNode<T> $nodeToAdd
     * @return AbstractNode<T>
     */
    public function getPositionToAddTo(AbstractNode $nodeToAdd): AbstractNode
    {
        $current = $this->head;

        if ($current === null) {
            throw new Exception('This should not happen'); // @todo refactor to use custom exception
        }

        while ($current->next !== null && $this->shouldBePlacedBefore($current->next->data, $nodeToAdd->data) === true) {
            $current = $current->next;
        }

        return $current;
    }

    /**
     * @param T $value
     * @param T $valueToCompareTo
     */
    public function shouldBePlacedBefore($value, $valueToCompareTo): bool
    {
        if ($this->sort === SortedLinkedListSortEnum::ASC) {
            return $value < $valueToCompareTo;
        }

        if ($this->sort === SortedLinkedListSortEnum::DESC) {
            return $value > $valueToCompareTo;
        }

        /** @phpstan-ignore-next-line */
        throw new UnresolvedSortingException($this->sort);
    }

    public function isEmpty(): bool
    {
        return $this->head === null;
    }

    /**
     * @param T $data
     * @return AbstractNode<T>
     */
    abstract public function createNode($data): AbstractNode;

}
