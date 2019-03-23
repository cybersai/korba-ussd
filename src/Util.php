<?php

namespace Korba;


final class Util
{
    /**
     * Prevent creating an object
     *  from this class
     */
    private function __construct(){ }

    /** @var int */
    const TERMINATION_CODE = 17;

    /** @var int  */
    const CONTINUE_CODE = 2;

    /**
     * @param string $code
     * @return string|null
     */
    public static function codeToNetwork($code) {
        if ($code == "01") {
            return "MTN";
        } else if ($code == "02") {
            return "VOD";
        } else if ($code == "06") {
            return "AIR";
        } else if ($code == "03") {
            return "TIG";
        } else {
            return null;
        }
    }

    /**
     * @return string
     */
    public static function random() {
        return rand(1000, 10000).rand(1000, 10000).rand(1000, 10000);
    }

    /**
     * @param string $number
     * @return string|string[]|null
     */
    public static function numberGHFormat($number) {
        return preg_replace("/^\+233/", "0", $number);
    }

    /**
     * @param string $number
     * @return string|string[]|null
     */
    public static function numberIntFormat($number) {
        return preg_replace('/^0/', '+233', $number);
    }

    /**
     * @param string $key
     * @param string $target
     * @param array[] $history
     * @param string $option
     */
    public static function processBack($key, $target, &$history, &$option) {
        if ($target === $key) {
            if (count($history) > 1) {
                array_pop($history);
                $index = count($history)  - 1;
                $option = $history[$index]->{'option'};
                array_pop($history);
            } else if (count($history) == 1) {
                $option = $history[0]->{'option'};
                array_pop($history);
            }
        }
    }

    /**
     * @param string $key
     * @param string $target
     * @param array[] $history
     * @param string $option
     */
    public static function processNext($key, &$target, &$history, &$option) {
        if ($target === $key) {
            if (count($history) > 0) {
                $index = count($history)  - 1;
                $option = $history[$index]->{'option'};
                array_pop($history);
                $target++;
            }
        }
    }

    /**
     * @param string $key
     * @param string $target
     * @param array[] $history
     * @param string $option
     */
    public static function processPrevious($key, &$target, &$history, &$option) {
        if ($target === $key) {
            if (count($history) > 0) {
                $index = count($history)  - 1;
                $option = $history[$index]->{'option'};
                array_pop($history);
                $target--;
            }
        }
    }
}
