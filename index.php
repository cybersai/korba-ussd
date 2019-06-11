<?php

require 'vendor/autoload.php';

$menu = new \Korba\Menu(false, true, true, true, false);
$submenu = new \Korba\SubMenu(1, 1,false, true, true, true, false);
$air_num_net = new \Korba\AirtimeNetNum(2);

echo $air_num_net->parseToString();

