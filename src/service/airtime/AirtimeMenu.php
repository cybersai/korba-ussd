<?php


namespace Korba;


class AirtimeMenu extends View implements Manipulator
{
    public function __construct()
    {
        $content = "Airtime Topup\n";
        $next = 'korba_airtime_net_num';
        $airtime_list = ["Own network", "Other network"];
        parent::__construct($content, $next, 1, 2, $airtime_list);
    }

    public function manipulate(&$tracker, $input)
    {
        if (View::getProcessBack() == $input) {
            $tracker->type = 'own';
        }
    }


}