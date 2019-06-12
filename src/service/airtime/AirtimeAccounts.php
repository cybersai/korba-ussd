<?php


namespace Korba;


class AirtimeAccounts extends Accounts implements Manipulator
{
    private $account_function;

    /**
     * AirtimeAccounts constructor.
     * @param UserAccounts $account_function
     * @param null|array $iterator
     * @param int $number_per_page
     */
    public function __construct($account_function, $iterator = null, $number_per_page = 4)
    {
        $next = 'korba_airtime_pin';
        $page = 1;
        $this->account_function = $account_function;
        parent::__construct($next, $page, $iterable_list = null, $iterator, $number_per_page);
    }

    public function manipulate(&$tracker, $input)
    {
        $account = call_user_func(array($this, 'getAccounts'), Util::numberGHFormat($tracker->phone_number));
        if (!$account) {
            $this->setNext('end');
        } else {
            $this->setIterableList($account);
        }
    }
}