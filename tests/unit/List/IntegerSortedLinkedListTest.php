<?php

declare(strict_types = 1);

namespace SortedLinkedList\Tests\List;

use PHPUnit\Framework\TestCase;
use SortedLinkedList\List\Exception\InvalidNodeTypePassedException;
use SortedLinkedList\List\IntegerSortedLinkedList;
use SortedLinkedList\Sort\SortedLinkedListSortEnum;

class IntegerSortedLinkedListTest extends TestCase
{

    /**
     * @dataProvider provideSortingData
     * @param int[] $expectedResult
     * @param int[] $data
     */
    public function testStateKeptSorted(
        array $expectedResult,
        SortedLinkedListSortEnum $sort,
        array $data
    ): void
    {
        $list = new IntegerSortedLinkedList($sort);
        foreach ($data as $singleData) {
            $list->insert($singleData);
        }

        self::assertSame($expectedResult, $list->toArray());
    }

    /**
     * @return mixed[]
     */
    public static function provideSortingData(): array
    {
        return [
            [
                [1, 2, 3],
                SortedLinkedListSortEnum::ASC,
                [3, 2, 1],
            ],
            [
                [3, 2, 1],
                SortedLinkedListSortEnum::DESC,
                [3, 2, 1],
            ],
        ];
    }

    /**
     * @dataProvider provideHasData
     * @param int[] $data
     */
    public function testHas(
        array $data,
        int $search,
        bool $expectedResult
    ): void
    {
        $list = new IntegerSortedLinkedList(SortedLinkedListSortEnum::ASC);
        foreach ($data as $singleData) {
            $list->insert($singleData);
        }

        self::assertSame($expectedResult, $list->has($search));
    }

    /**
     * @return mixed[]
     */
    public static function provideHasData(): array
    {
        return [
            [
                [1, 2, 3],
                2,
                true,
            ],
            [
                [1, 2, 3],
                4,
                false,
            ],
            [
                [],
                3,
                false,
            ],
        ];
    }

    public function testRemove(): void
    {
        $list = new IntegerSortedLinkedList(SortedLinkedListSortEnum::ASC);
        $list->insert(1);
        $list->insert(2);
        $list->insert(3);

        $list->remove(2);

        self::assertSame([1, 3], $list->toArray());
    }

    public function testRemoveWillNotRemoveMultipleNodes(): void
    {
        $list = new IntegerSortedLinkedList(SortedLinkedListSortEnum::ASC);
        $list->insert(1);
        $list->insert(2);
        $list->insert(2);
        $list->insert(3);

        $list->remove(2);

        self::assertSame([1, 2, 3], $list->toArray());
    }

    public function testToGenerator(): void
    {
        $list = new IntegerSortedLinkedList(SortedLinkedListSortEnum::ASC);
        $list->insert(1);
        $list->insert(2);
        $list->insert(3);

        $generator = $list->toGenerator();
        self::assertSame(1, $generator->current());

        $generator->next();
        self::assertSame(2, $generator->current());

        $generator->next();
        self::assertSame(3, $generator->current());

        $generator->next();
        self::assertNull($generator->current());
    }

    public function testIsEmpty(): void
    {
        $list = new IntegerSortedLinkedList(SortedLinkedListSortEnum::ASC);
        self::assertTrue($list->isEmpty());

        $list->insert(1);
        self::assertFalse($list->isEmpty());
    }

    public function testPassInvalidData(): void
    {
        $list = new IntegerSortedLinkedList(SortedLinkedListSortEnum::ASC);

        $this->expectException(InvalidNodeTypePassedException::class);

        /** @phpstan-ignore-next-line */
        $list->insert('a');
    }

}
