<?php

/**
 * Class Param at src/Param.php.
 * File containing Param class
 * @api
 * @author Isaac Adzah Sai <isaacsai030@gmail.com>
 * @version 2.5.2
 */
namespace Korba;

/**
 * Class Param maintains uniformity between classes.
 * A class that holds constant params to be used by other class to ensure uniformity.
 * @package Korba
 */
class Param
{
    /**
     * Param private constructor.
     * This construct prevents creating an instance of the class since it has only static methods.
     */
    private function __construct() { }

    /** @var string constant phone_number */
    const PHONE_NUMBER = 'phone_number';
    /** @var string constant session_id */
    const SESSION_ID = 'session_id';
    /** @var string constant network */
    const NETWORK = 'network';
    /** @var string constant option */
    const OPTION = 'option';
    /** @var string constant target */
    const TARGET = 'target';
    /** @var string constant history */
    const HISTORY = 'history';
    /** @var string constant payload */
    const PAYLOAD = 'payload';
    /** @var string constant account_number */
    const ACCOUNT_NUMBER = 'account_number';
    /** @var string constant amount */
    const AMOUNT = 'amount';
    /** @var string constant purpose */
    const PURPOSE = 'purpose';
    /** @var string constant authorization */
    const AUTHORIZATION = 'authorization';
    /** @var string constant type */
    const TYPE = 'type';
    /** @var string constant transaction_id */
    const TRANSACTION_ID = 'transaction_id';
    /** @var string constant param */
    const PARAM = "param";
}
