# PHP implemetation of sorted linked list
Library providing support of sorted linked list in PHP.
Currently supporting integers (`IntegerSortedLinkedList`) and strings (`StringSortedLinkedList`).
To implement custom type, extend `AbstractSortedLinkedList` and use custom `AbstractNode` implementation.

## Usage
```php
# new instance of list:
$sortedList = new IntegerSortedLinkedList();

# list is mutable, to add items:
$sortedList->insert(1);
$sortedList->insert(2);
$sortedList->insert(3);

# to delete items
$sortedList->remove(2);

#to check item existence
$sortedList->has(2);

# to check if is empty
$sortedList->isEmpty();

# to get items
$sortedList->get(2);

# to get all items retrieve array or generator
$sortedList->toArray() # watch out for memory usage in case of large lists, intentioned primarily for debugging purposes
$sortedList->toGenerator()
```

## Contribute
- to run checks (phpcs, phpstan, phpunit), run `composer check`, or see `composer.json` for more details