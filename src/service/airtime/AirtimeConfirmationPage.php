<?php


namespace Korba;


class AirtimeConfirmationPage extends ConfirmationPage implements Manipulator
{
    public function __construct($provider = '', $account = '', $amount = '', $fee = '')
    {
        $next = 'korba_airtime_auth';
        parent::__construct($next, $provider, $account, $amount, $fee);
    }

    public function manipulate(&$tracker, $input)
    {
        $payload = json_decode($tracker->payload, true);
        if ($tracker->type == 'own') {
            $this->setAll(AirtimeNetwork::$human_network[$payload['network']], $payload['number'], $input);
        } else {
            $this->setAll($tracker->network, Util::numberGHFormat($tracker->phone_number), $input);
        }
        if (!Util::verifyAmount($input)) {
            $this->setNext('end');
        }
    }
}