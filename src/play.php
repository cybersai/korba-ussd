<?php

include_once '../vendor/autoload.php';

$data = [['id' => 1, 'name' => 'Isaac'], ['id' => 2, 'name' => 'Sai']];

$view =  new \Korba\GenericView(['Welcome to my Usssd libray', 'Good to be here'], ['airtime', 'nice'], '1', 3, $data, ['id', 'name']);

echo $view->parseToString();
echo '<br/>';
echo $view->getNext();
