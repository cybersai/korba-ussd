<?php

require 'vendor/autoload.php';

$menu = new \Korba\Menu(false, true, true, true, false);
$submenu = new \Korba\Sub(1, 1,false, true, true, true, false);
$air_num_net = new \Korba\AirtimeNetNum(2);
$group_menu = new \Korba\ViewGroup([$menu, $submenu, $air_num_net]);

//echo $air_num_net->parseToString();
echo $group_menu->getView(3)->parseToString();
