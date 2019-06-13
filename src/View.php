<?php

namespace Korba;

/**
 * @todo
 * Update Docs and Readme
 */

class View {
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
    /** @var string[]|object[] */
    private $iterator;
    /** @var string|string[] */
    private $end;

    /** @var null|string */
    private static $processNext = null;
    /** @var null|string */
    private static $processBack = null;
    /** @var null|string */
    private static $processPrevious = null;
    /** @var null|string */
    private static $processBeginning = null;

    /**
     * View constructor.
     * @param string|string[] $content
     * @param string|string[] $next
     * @param integer $page
     * @param integer $number_per_page
     * @param object[]|string[] $iterable_list
     * @param string[] $iterator
     * @param string|string[] $end
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
     * @param string|string[] $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @param string|string[] $next
     */
    public function setNext($next)
    {
        $this->next = $next;
    }

    /**
     * @param int $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @param int $number_per_page
     */
    public function setNumberPerPage($number_per_page)
    {
        $this->number_per_page = $number_per_page;
    }

    /**
     * @param object[]|string[] $iterable_list
     */
    public function setIterableList($iterable_list)
    {
        $this->iterable_list = $iterable_list;
    }

    /**
     * @param object[]|string[] $iterator
     */
    public function setIterator($iterator)
    {
        $this->iterator = $iterator;
    }

    /**
     * @param string|string[] $end
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }



    /**
     * @return string
     */
    public function getContent()
    {
        if (gettype($this->content) === 'array') {
            return $this->content[$this->page - 1];
        }
        return $this->content;
    }

    /**
     * @return string
     */
    public function getNext()
    {
        if (gettype($this->next)  === 'array') {
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
        if (gettype($this->end)  === 'array') {
            return $this->end[$this->page - 1];
        }
        return $this->end;
    }

    /**
     * @return string
     */
    public function parseToString()
    {
        return "{$this->getContent()}\n{$this->makeList()}\n{$this->getEnd()}";
    }

    /**
     * @return string
     */
    private function makeList()
    {
        $msg = "";
        if ($this->page != null &&
            $this->number_per_page != null &&
            $this->iterable_list != null) {
            $limit = ($this->page * $this->number_per_page <= count($this->iterable_list)) ? $this->number_per_page : (count($this->iterable_list) - ($this->page * $this->number_per_page - $this->number_per_page));
            $is_last_page = ($this->page * $this->number_per_page < count($this->iterable_list)) ? false : true;
            $is_first_page = ($this->page == 1) ? true : false;
            $start_index = $this->number_per_page * $this->page - $this->number_per_page;
            for($i = 0;$i < $limit;$i++) {
                $num = $i + $start_index + 1;
                if ($this->iterator == null) {
                    $msg .= "{$num}.{$this->iterable_list[$i + $start_index]}\n";
                } else {
                    $msg .= "{$num}.{$this->iterable_list[$i + $start_index][$this->iterator[1]]}\n";
                }
            }
            if (self::$processNext) {
                if (!$is_last_page) {
                    $msg .= self::$processNext."."."Next Page\n";
                }
            }
            if (self::$processPrevious) {
                if (!$is_first_page) {
                    $msg .= self::$processPrevious."."."Previous Page\n";
                }
            }
            return $msg;
        }
    }

    /**
     * @param integer $page
     * @param integer $number_per_page
     * @param string[]|array[] $array
     * @param null|string[] $nested_indices
     * @return string
     */
    public static function arrayToList($page, $number_per_page, $array, $nested_indices = null) {
        $msg = "";
        $limit = ($page * $number_per_page <= count($array)) ? $number_per_page : (count($array) - ($page * $number_per_page - $number_per_page));
        $is_last_page = ($page * $number_per_page < count($array)) ? false : true;
        $is_first_page = ($page == 1) ? true : false;
        $start_index = $number_per_page * $page - $number_per_page;
        for($i = 0;$i < $limit;$i++) {
            $num = $i + $start_index + 1;
            if ($nested_indices == null) {
                $msg .= "{$num}.{$array[$i + $start_index]}\n";
            } else {
                $msg .= "{$num}.{$array[ + $start_index][$nested_indices[1]]}\n";
            }
        }
        if (self::$processNext) {
            if (!$is_last_page) {
                $msg .= self::$processNext."."."Next Page\n";
            }
        }
        if (self::$processPrevious) {
            if (!$is_first_page) {
                $msg .= self::$processPrevious."."."Previous Page\n";
            }
        }
        return $msg;
    }

    /**
     * @param string $key
     */
    public static function setProcessNext($key) {
        self::$processNext = $key;
    }

    /**
     * @param string $key
     */
    public static function setProcessBack($key) {
        self::$processBack = $key;
    }

    /**
     * @param string $key
     */
    public static function setProcessPrevious($key) {
        self::$processPrevious = $key;
    }

    /**
     * @param string $key
     */
    public static function setProcessBeginning($key) {
        self::$processBeginning = $key;
    }

    /**
     * @return null|string
     */
    public static function getProcessNext() {
        return self::$processNext;
    }

    /**
     * @return null|string
     */
    public static function getProcessBack() {
        return self::$processBack;
    }

    /**
     * @return null|string
     */
    public static function getProcessPrevious() {
        return self::$processPrevious;
    }

    /**
     * @return null|string
     */
    public static function getProcessBeginning() {
        return self::$processBeginning;
    }

    public function canManipulate(&$tracker, $input) {
        if (method_exists($this, 'manipulate')) {
            call_user_func_array(array($this, 'manipulate'), array(&$tracker, $input));
        }
    }
}
