<?php


namespace Korba;


class ExampleVerifyPayment extends VerifyPayment {

    public function process(&$tracker, $input)
    {
        $paid = true;
        if ($paid) {
            $this->setView($this->getView(1));
//            print_r($this->getSelectedView(1));
//            echo '<br><br>';
//            $this->getSelectedView(1)->setContent('Testing 2');

//            echo $this->getSelectedView(1)->getContent()."<br>";
            $this->getSelectedView(1)->setIterator(['acc_no', 'acc_name']);
        } else {
            $this->setView($this->getView(2));
        }
    }
}