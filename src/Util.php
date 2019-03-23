<?php

namespace Korba;


final class Util
{
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
}
