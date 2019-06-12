<?php


namespace Korba;


class Services extends Collection
{
    public function __construct()
    {
        $collection = [
            'korba_menu' => new Menu(),
            'korba_sub_menu' => new SubMenu(),
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