<?php

include_once '../vendor/autoload.php';

$data = [['id' => 1, 'name' => 'Isaac'], ['id' => 2, 'name' => 'Sai']];

$view =  new \Korba\Menu(['Welcome to my Usssd libray', 'Good to be here'], ['airtime', 'nice'], '1', 3, $data, ['id', 'name'], 'End 2');

echo $view->parseToString();
echo '<br/>';
echo $view->getNext();
echo '<br/>';
echo \Korba\Util::random();

$history = [['param' => null, 'option' => 'MENU'],['param' => '1', 'option' => 'SPECIFIC'], ['param' => '1', 'option' => 'AIRTIME']];
$n = 3;
$hist = \Korba\Util::processNext("#", $n, $history);
print_r($history);
echo $n;
