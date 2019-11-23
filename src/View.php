<?php

namespace Korba;

/**
 * Class View.
 * Class to help easy generate ussd menus
 * @package Korba
 */

class View {
    /** @var string|string[] $content Content of the ussd menu or the starting */
    private $content;
    /** @var string|string[] $next Link to the next menu tag */
    private $next;
    /** @var integer $page Current page number of menu */
    private $page;
    /** @var integer $number_per_page Total number of pages of the menu */
    private $number_per_page;
    /** @var object[]|string[] $iterable_list List of object to put on page */
    private $iterable_list;
    /** @var string[]|object[] $iterator index and parameter of the iterable_list to display */
    private $iterator;
    /** @var string|string[] $end Content to append to menu's ending */
    private $end;

    /** @var null|string $processNext Key to show if there is next page */
    private static $processNext = null;
    /** @var null|string $processBack Key to show if there is back page */
    private static $processBack = null;
    /** @var null|string $processPrevious Key to show if there is a previous page */
    private static $processPrevious = null;
    /** @var null|string $processBeginning Key to show if there is beginning page */
    private static $processBeginning = null;

    /**
     * View constructor.
     * It used to create a new instance of the View Class.
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
        $this->next = strtoupper($next);
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
     * View public function parseToString.
     * It compiles the menus to String format possible to display on phone
     * @return string
     */
    public function parseToString()
    {
        return "{$this->getContent()}\n{$this->makeList()}\n{$this->getEnd()}";
    }

    /**
     * View public function makeList
     * It generates the list for a particular page
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
     * View public static function arrayToList
     * It converts a given array to list in string format possible to display on phone
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
                $msg .= "{$num}.{$array[$i + $start_index][$nested_indices[1]]}\n";
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
}
