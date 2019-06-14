<?php


namespace Korba;


class ExampleVerifyAccounts extends VerifyAccounts {

    public function getAccount($num)
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
//            print_r($this->getSelectedView(1));
//            echo '<br><br>';
            $this->getSelectedView(1)->setContent('Testing 2');
            $this->getSelectedView(1)->setIterableList($accounts);
            $this->getSelectedView(1)->setPage(1);
            $this->getSelectedView(1)->setNumberPerPage(4);
//            echo $this->getSelectedView(1)->getContent()."<br>";
            $this->getSelectedView(1)->setIterator(['acc_no', 'acc_name']);
        } else {
            $this->setView($this->getView(2));
            if ($tracker->network == 'VOD') {
                $this->getSelectedView(2)->setNext('korba_airtime_vod');
            }
        }
    }
}