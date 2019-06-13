<?php

require 'vendor/autoload.php';

$menu = new \Korba\Menu(false, true, true, true, false);
$submenu = new \Korba\SubMenu(1, 1,false, true, true);
$air_num_net = new \Korba\Amount("test");
$group_menu = new \Korba\ViewGroup([$menu, $air_num_net]);

$collection = new \Korba\Collection(["menu" => $menu,"submenu" => $submenu, "group" => $group_menu]);
$service = new \Korba\Services();
$tracker = new stdClass();
$input = 1;

//echo $air_num_net->parseToString();
//echo $group_menu->getView(3)->parseToString();
//echo $collection->getCurrentView("group", 1)->parseToString();
//echo $service->getCurrentView(strtoupper('korba_airtime_num'),1)->parseToString();
$service->getCurrentView(strtoupper('korba_airtime_num'),1)->canManipulate($tracker, $input);

