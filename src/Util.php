<?php

namespace Korba;


final class Util
{
    /** @var int */
    const TERMINATION_CODE = 17;

    /**
     * @param string $code
     * @return string|null
     */
    public function codeToNetwork($code) {
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
}
