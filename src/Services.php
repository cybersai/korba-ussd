<?php


namespace Korba;


final class Services extends Collection
{
    private $accounts;

    public function __construct(&$tracker, $accounts = null, $available = [false, true, true, true, true])
    {
        $this->accounts = $accounts;
        $collection = [
            'korba_menu' => new Menu(...$available),
            'korba_sub_menu' => new SubMenu(...$available),
            'korba_airtime_net_num' => new AirtimeNetNum(),
            'korba_airtime_num' => new AirtimeNumber(),
            'korba_airtime_num_confirm' => new Confirm('korba_airtime_amount', 'recipient'),
            'korba_airtime_amount' => new Amount('korba_airtime_confirmation'),
            'korba_airtime_confirmation' => new ConfirmationPage('korba_airtime_auth', 'MTN', '0545112466', '2'),
            'korba_airtime_auth' => new Thanks('MTN')
        ];
        parent::__construct($collection);
    }
}