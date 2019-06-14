<?php


namespace Korba;


class AirtimeConfirmationPage extends ConfirmationPage implements Manipulator
{
    public function __construct($next = 'korba_airtime_auth', $provider = '', $account = '', $amount = 0, $fee = 0)
    {
        parent::__construct($next, $provider, $account, $amount, $fee);
    }

    public function manipulate(&$tracker, $input)
    {
        $payload = json_decode($tracker->payload, true);
        if ($tracker->type == 'own') {
            $this->setAll(AirtimeNetwork::$human_network[$payload['network']], $payload['number'], $input);
        } else {
            $this->setAll(AirtimeNetwork::$human_network[$tracker->network], Util::numberGHFormat($tracker->phone_number), $input);
        }
        if ($tracker->authorization != 'registered') {
            $this->setNext('korba_airtime_auth');
        }
        $tracker->amount = $input;
    }
}