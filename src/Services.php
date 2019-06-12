<?php


namespace Korba;


final class Services extends Collection
{
    private $accounts;

    public function __construct($accounts_function = null, $available = [false, true, true, true, true])
    {
        $this->accounts = $accounts_function;

        $collection = [
            'korba_menu' => new Menu(...$available),
            'korba_sub_menu' => new SubMenu(...$available),
            'korba_airtime_net_num' => new AirtimeNetNum(),
            'korba_airtime_num' => new AirtimeNumber(),
            'korba_airtime_num_confirm' => new AirtimeConfirm(),
            'korba_airtime_amount' => new AirtimeAmount(),
            'korba_airtime_confirmation' => ( $accounts_function ? new AirtimeAccounts($accounts_function, ['']) : new AirtimeConfirmationPage()),
            'korba_airtime_pin' => new AirtimePin(),
            'korba_airtime_auth' => new Thanks('MTN')
        ];
        parent::__construct($collection);
    }
}