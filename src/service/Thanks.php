<?php


namespace Korba;


class Thanks extends View
{
    public function __construct($network = "INF", $success = false)
    {
        if ($success) {
            $content = "Thanks, transaction completed Successfully";
        } else {
            if ($network == "MTN") {
                $content = "Please wait for prompt to authorize";
            } else if ($network = "VOD") {
                $content = "Please wait for prompt to authorize";
//                $content = "Transaction is being processed, you will receive an SMS soon";
            } else if ($network == "AIR") {
                $content = "Please wait for prompt to authorize";
            } else if ($network == "TIG") {
                $content = "Please wait for prompt to authorize";
            } else {
                $content = "Transaction unsuccessful";
            }
        }
        $next = 'end';
        parent::__construct($content, $next);
    }
}
