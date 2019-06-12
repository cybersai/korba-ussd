<?php


namespace Korba;


class Collection
{
    /** @var View[]|ViewGroup[] */
    private $collection;

    public function __construct($collection)
    {
        $this->collection = array_change_key_case($collection, CASE_UPPER);
    }

    /**
     * @param string $view
     * @param int $page
     * @return View
     */
    public function getCurrentView($view, $page = 1) {
        return $this->collection[$view] instanceof View ? $this->collection[$view] : $this->collection[$view]->getView($page);
    }

    public function getViews() {
        return json_encode($this->collection);
    }
}
