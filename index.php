<?php

require 'vendor/autoload.php';

class Verify extends \Korba\VerifyAccounts {

    public function getAccount($num, $pos)
    {
        $accounts = [
            ['acc_no' => '2313123', 'acc_name' => 'Test'],
            ['acc_no' => '312312', 'acc_name' => 'Test 2']
        ];
        return $accounts[$num - 1];
    }

    public function process(&$tracker, $input)
    {
        $accounts = [
            ['acc_no' => '2313123', 'acc_name' => 'Test'],
            ['acc_no' => '312312', 'acc_name' => 'Test 2']
        ];
        if ($accounts) {
            $this->setView($this->getView(1));
            print_r($this->getSelectedView(1));
            echo '<br><br>';
            $this->getSelectedView(1)->setContent('Testing 2');
            $this->getSelectedView(1)->setIterableList($accounts);
            $this->getSelectedView(1)->setPage(1);
            $this->getSelectedView(1)->setNumberPerPage(4);
            echo $this->getSelectedView(1)->getContent()."<br>";
            $this->getSelectedView(1)->setIterator(['acc_no', 'acc_name']);
        } else {
            $this->setView($this->getView(2));
            if ($tracker->network == 'VOD') {
                $this->getSelectedView(2)->setNext('korba_airtime_vod');
            }
        }
    }
}

class VerifyP extends \Korba\VerifyPayment {

    public function process(&$tracker, $input)
    {
        $paid = false;
        if ($paid) {
            $this->setView($this->getView(1));
            print_r($this->getSelectedView(1));
            echo '<br><br>';
//            $this->getSelectedView(1)->setContent('Testing 2');

            echo $this->getSelectedView(1)->getContent()."<br>";
            $this->getSelectedView(1)->setIterator(['acc_no', 'acc_name']);
        } else {
            $this->setView($this->getView(2));
        }
    }
}






//$verify = new Verify();
//$pverify = new VerifyP();
//$tracker = new stdClass();
//$tracker->payload = json_encode(['network' => 'GLO', ]);
//$tracker->network = 'VOD';
//$tracker->type = 'own';
//$tracker->authorization = 'non-registered';
//$input = '0545112466';
//$option = 'korba_airtime_num_confirm';
//$service = new \Korba\Services($pverify);
//$service->canProcess($tracker, $input, strtoupper($option));
//$response = $service->getCurrentView(strtoupper($option), $input);
//$response->canManipulate($tracker, $input);
//echo "<br>".$response->parseToString()."<br>";
//print_r($tracker);
//echo "<br>".$response->getNext();
$tracker = new stdClass();
$tracker->payload = '';
$tracker->type = 'own';
$tracker->authorization = 'registered';
$tracker->phone_number = '+233545112466';
$tracker->network = 'MTN';
$input = '1';
$target = '1';
$option = 'KORBA_AIRTIME_ACC_MOMO';

$response = \Korba\ExampleServiceScript::copyMe($tracker, $input, $target, strtoupper($option));
echo $response->parseToString()."<br>";
echo $response->getNext();


