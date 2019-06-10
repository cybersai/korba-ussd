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

$views = array('first' => $firstView, 'second' => $secondView, 'third' => $thirdView, $wel);

$collection = new \Korba\Collection($views);

$hist = [
    ['param' => null, 'option' => "MAIN_MENU"],
    ['param' => '1', 'option' => "SECOND"],
    ['param' => '2323', 'option' => "THIRD"],
    ['param' => '342', 'option' => "FOURTH"]
];

$opt = "FIFTH";

$in = "0";

$his = json_encode($hist);

$new_his = \Korba\Util::parseHistoryToArray($his);

\Korba\Util::redirect('0', $in, $new_his, $opt, "FIFTH", "SECOND");
$x = new \Korba\XChangeV1("123123", "34234", "1344");

print_r($new_his);
echo $opt;

