<?php

require '../vendor/autoload.php';

class Wel extends \Korba\View {
    public function __construct() {
        parent::__construct("Wel", "test_4");
    }
}

$firstView = new \Korba\View("First", "test_1");
$secondView = new \Korba\View("Second", "test_2");
$thirdView = new \Korba\View("Third", "test_3");
$wel = new Wel();

$views = array($firstView, $secondView, $thirdView, $wel);

$collection = new \Korba\Collection($views);
