<?php namespace Korba;

/**
 * @todo
 * content could be array
 * next could also be array
 * check if it an array or string
 * and use accordingly
 * add a parameter to specify use input
 */

class GenericView {
    /** @var string|string[] */
    private $content;
    /** @var string|string[] */
    private $next;
    /** @var integer */
    private $page;
    /** @var integer */
    private $number_per_page;
    /** @var object[]|string[] */
    private $iterable_list;
    /** @var string[] */
    private $iterator;
    /** @var string */
    private $end;

    /**
     * View constructor.
     * @param string|string[] $content
     * @param string|string[] $next
     * @param integer $page
     * @param integer $number_per_page
     * @param object[]|string[] $iterable_list
     * @param string[] $iterator
     * @param string $end
     */
    public function __construct($content , $next, $page = 1, $number_per_page = null, $iterable_list = null, $iterator = null, $end = null)
    {
        $this->content = $content;
        $this->next = (gettype($next) == 'array' ? array_map('strtoupper', $next): strtoupper($next));
        $this->page = intval($page);
        $this->number_per_page = intval($number_per_page);
        $this->iterable_list = $iterable_list;
        $this->iterator = $iterator;
        $this->end = $end;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        if (gettype($this->content == 'array')) {
            return $this->content[$this->page - 1];
        }
        return $this->content;
    }

    /**
     * @return string
     */
    public function getNext()
    {
        if (gettype($this->next == 'array')) {
            return $this->next[$this->page - 1];
        }
        return $this->next;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getNumberPerPage()
    {
        return $this->number_per_page;
    }

    /**
     * @return object[]|string[]
     */
    public function getIterableList()
    {
        return $this->iterable_list;
    }

    /**
     * @return string[]
     */
    public function getIterator()
    {
        return $this->iterator;
    }

    /**
     * @return string
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @return string
     */
    public function parseToString()
    {
        $msg = "";
        $msg .= "{$this->getContent()}\n";
        $msg .= $this->makeList();
        return $msg;
    }

    /**
     * @return string
     */
    private function makeList()
    {
        $msg = "";
        if ($this->page != null &&
            $this->number_per_page != null &&
            $this->iterable_list != null &&
            $this->iterator != null) {
            $limit = ($this->page * $this->number_per_page <= count($this->iterable_list)) ? $this->number_per_page : (count($this->iterable_list) - ($this->page * $this->number_per_page - $this->number_per_page));
            $is_last_page = ($this->page * $this->number_per_page < count($this->iterable_list)) ? false : true;
            $is_first_page = ($this->page == 1) ? true : false;
            $start_index = $this->number_per_page * $this->page - $this->number_per_page;
            for($i = $start_index;$i < $limit;$i++) {
                $num = $i + 1;
                $msg .= "{$num}.{$this->iterable_list[$i][$this->iterator[1]]}\n";
            }
            return $msg;
        }
    }
}
