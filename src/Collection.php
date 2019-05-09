<?php


namespace Korba;


class Collection
{
    /** @var array */
    private $collection;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    public function getCurrentView($view) {
        return $this->collection[$view];
    }
}
