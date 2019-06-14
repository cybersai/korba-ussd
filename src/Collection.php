<?php


namespace Korba;


class Collection
{
    /** @var View[]|ViewGroup[]|Worker[] */
    private $collection;

    public function __construct($collection)
    {
        $this->collection = array_change_key_case($collection, CASE_UPPER);
    }

    public function canProcess(&$tracker, $input, $view) {
        if (method_exists($this->collection[$view], 'process')) {
            call_user_func_array(array($this->collection[$view], 'process'), array(&$tracker, $input));
        }
    }

    /**
     * @param string $view
     * @param int $page
     * @return View
     */
    public function getCurrentView($view, $page = 1) {
        if ($this->collection[$view] instanceof Worker) {
            return $this->collection[$view]->getSelectedView($page);
        }
        return $this->collection[$view] instanceof View ? $this->collection[$view] : $this->collection[$view]->getView($page);
    }

    public function getViews() {
        return json_encode($this->collection);
    }
}
