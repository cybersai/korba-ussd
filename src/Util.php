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
        return rand(1000, 10000).rand(1000, 10000).rand(1000, 10000).rand(1000, 10000);
    }

    /**
     * @param string $int_number
     * @return string|string[]|null
     */
    public static function numberGHFormat($int_number) {
        if (preg_match('/^\+233/', $int_number)) {
            return preg_replace("/^\+233/", "0", $int_number);
        }
        return preg_replace('/^233/', '0', $int_number);
    }

    /**
     * @param string $gh_number
     * @return string|string[]|null
     */
    public static function numberIntFormat($gh_number) {
        if (preg_match('/^0/', $gh_number)) {
            return preg_replace('/^0/', '+233', $gh_number);
        }
        return preg_replace('/^233/', '+233', $gh_number);
    }

    /**
     * @param string $number
     * @return string|string[]|null
     */
    public static function number233Format($number) {
        if (preg_match('/^0/', $number)) {
            return preg_replace('/^0/', '233', $number);
        }
        return preg_replace('/^\+233/', '233', $number);
    }

    /**
     * @param string $key
     * @param string $value
     * @param array[] $history
     * @param string $option
     */
    public static function processBack($key, &$value, &$history, &$option) {
        if ($value === $key) {
            array_pop($history);
            if (count($history) > 1) {
                $index = count($history)  - 1;
                $option = $history[$index]->{'option'};
                $value = $history[$index]->{'param'};
                array_pop($history);
            } else if (count($history) == 1) {
                $option = $history[0]->{'option'};
                array_pop($history);
            }
        }
    }

    /**
     * @param string $key
     * @param string $value
     * @param string $target
     * @param array[] $history
     * @param string $option
     */
    public static function processNext($key, &$value, &$target, &$history, &$option) {
        if ($value === $key) {
            if (count($history) > 0) {
                $index = count($history)  - 1;
                $option = $history[$index]->{'option'};
                $value = $history[$index]->{'param'};
                array_pop($history);
                $target++;
            }
        }
    }

    /**
     * @param string $key
     * @param string $value
     * @param string $target
     * @param array[] $history
     * @param string $option
     */
    public static function processPrevious($key, &$value, &$target, &$history, &$option) {
        if ($value === $key) {
            if (count($history) > 0) {
                $index = count($history)  - 1;
                $option = $history[$index]->{'option'};
                $value = $history[$index]->{'param'};
                array_pop($history);
                $target--;
            }
        }
    }

    /**
     * @param string[] $keys
     * @param string $value
     * @param integer $target
     */
    public static function processReset($keys, $value, &$target) {
        if (!in_array($value, $keys)) {
            $target = 1;
        }
    }

    /**
     * @param string $key
     * @param string $value
     * @param array[] $history
     * @param string $option
     */
    public static function processBeginning($key, &$value, &$history, &$option) {
        if ($value === $key) {
            if (count($history) > 0) {
                $option = $history[0]->{'option'};
                $value = $history[0]->{'param'};
                $history = array();
            }
        }
    }

    /**
     * @param string $number
     * @return boolean
     */
    public static function verifyPhoneNumber($number) {
        return preg_match("/^[0][0-9]{9}$/", $number) ? true : false;
    }

    /**
     * @param string $number
     * @return boolean
     */
    public static function verifyNumberLength($number, $length = 10) {
        return preg_match("/^[0-9]{".$length."}$/", $number) ? true : false;
    }

    /**
     * @param string $number
     * @return boolean
     */
    public static function verifyWholeNumber($number) {
        return preg_match("/^[1-9][0-9]*$/", $number) ? true : false;
    }

    /**
     * @param string $amount
     * @return boolean
     */
    public static function verifyAmount($amount) {
        return preg_match("/^[0-9]+(?:\.[0-9]{1,2})?$/", $amount) ? true : false;
    }

    /**
     * @param string $number
     * @return boolean
     */
    public static function verifyNumber($number) {
        return preg_match("/^[0-9]*$/", $number) ? true : false;
    }

    /**
     * @param $request
     * @param View $response
     * @param string $option
     * @param null|string $auth
     * @param null|string $type
     * @return array
     */
    public static function requestToHashedMapArray($request, $response, $option = "MAIN_MENU", $auth = null, $type = null) {
        return [
            Param::PHONE_NUMBER => $request->msisdn,
            Param::SESSION_ID => $request->sessionID,
            Param::NETWORK => Util::codeToNetwork($request->network),
            Param::OPTION => $response->getNext(),
            Param::TYPE => $type,
            Param::AUTHORIZATION => $auth,
            Param::HISTORY => json_encode([
                [Param::PARAM => 'null', Param::OPTION => $option]
            ]),
            Param::TRANSACTION_ID => Util::random()
        ];
    }

    /**
     * @param $request
     * @return bool
     */
    public static function isInitialRequest($request) {
        return ($request->ussdServiceOp == 1 ? true : false);
    }

    /**
     * @param $request
     * @return string
     */
    public static function getRequestSessionId($request) {
        return $request->sessionID;
    }

    /**
     * @param string $history
     * @return array
     */
    public static function parseHistoryToArray($history) {
        return (array)json_decode($history);
    }

    /**
     * @param View $response
     * @param integer $code
     * @return array
     */
    public static function parseResponseToArray($response, $code) {
        return [
            'message' => $response->parseToString(),
            'ussdServiceOp' => $code
        ];
    }

    /**
     * @param array $history
     * @param string $input
     * @param string $option
     */
    public static function appendHistory(&$history, $input, $option) {
        array_push($history, [
                'param' => $input,
                'option' => $option
            ]
        );
    }

    /**
     * @param string $key
     * @param string $value
     * @param array[] $history
     * @param string $option
     * @param string $from
     * @param string $to
     */
    public static function reverse($key, &$value, &$history, &$option, $from, $to) {
        if ($value === $key && $from === $option) {
            for($i = count($history) - 1;$i >= 1;$i--) {
                if ($history[$i]->{'option'} === $to) {
                    $option = $history[$i]->{'option'};
                    $value = $history[$i]->{'param'};
                    array_pop($history);
                    break;
                } else {
                    array_pop($history);
                }
            }
        }
    }

    /**
     * @param string $key
     * @param string $value
     * @param string $new_value
     * @param array[] $history
     * @param string $option
     * @param string $from
     * @param string $to
     */
    public static function redirect($key, &$value, $new_value, &$option, $from, $to) {
        if ($value === $key && $from === $option) {
            $option = $to;
            $value = $new_value;
        }
    }
}
