<?php

declare(strict_types = 1);

namespace SortedLinkedList\Tests\List;

use PHPUnit\Framework\TestCase;
use SortedLinkedList\List\StringSortedLinkedList;
use SortedLinkedList\Sort\SortedLinkedListSortEnum;

class StringSortedLinkedListTest extends TestCase
{

    /**
     * @dataProvider provideSortingData
     * @param string[] $expectedResult
     * @param string[] $data
     */
    public function testStateKeptSorted(
        array $expectedResult,
        SortedLinkedListSortEnum $sort,
        array $data
    ): void
    {
        $list = new StringSortedLinkedList($sort);
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
                ['a', 'b', 'c'],
                SortedLinkedListSortEnum::ASC,
                ['c', 'b', 'a'],
            ],
            [
                ['c', 'b', 'a'],
                SortedLinkedListSortEnum::DESC,
                ['c', 'b', 'a'],
            ],
        ];
    }

    /**
     * @dataProvider provideHasData
     * @param string[] $data
     */
    public function testHas(
        array $data,
        string $search,
        bool $expectedResult
    ): void
    {
        $list = new StringSortedLinkedList(SortedLinkedListSortEnum::ASC);
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
                ['a', 'b', 'c'],
                'b',
                true,
            ],
            [
                ['a', 'b', 'c'],
                'd',
                false,
            ],
            [
                [],
                'd',
                false,
            ],
        ];
    }

    public function testRemove(): void
    {
        $list = new StringSortedLinkedList(SortedLinkedListSortEnum::ASC);
        $list->insert('a');
        $list->insert('b');
        $list->insert('c');

        $list->remove('b');

        self::assertSame(['a', 'c'], $list->toArray());
    }

    public function testRemoveWillNotRemoveMultipleNodes(): void
    {
        $list = new StringSortedLinkedList(SortedLinkedListSortEnum::ASC);
        $list->insert('a');
        $list->insert('b');
        $list->insert('b');
        $list->insert('c');

        $list->remove('b');

        self::assertSame(['a', 'b', 'c'], $list->toArray());
    }

    public function testToGenerator(): void
    {
        $list = new StringSortedLinkedList(SortedLinkedListSortEnum::ASC);
        $list->insert('a');
        $list->insert('b');
        $list->insert('c');

        $generator = $list->toGenerator();
        self::assertSame('a', $generator->current());

        $generator->next();
        self::assertSame('b', $generator->current());

        $generator->next();
        self::assertSame('c', $generator->current());

        $generator->next();
        self::assertNull($generator->current());
    }

    public function testIsEmpty(): void
    {
        $list = new StringSortedLinkedList(SortedLinkedListSortEnum::ASC);
        self::assertTrue($list->isEmpty());

        $list->insert('a');
        self::assertFalse($list->isEmpty());
    }

}
