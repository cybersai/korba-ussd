<?php

require 'vendor/autoload.php';

$menu = new \Korba\Menu(false, true, true, true, false);
$submenu = new \Korba\SubMenu(1, 1,false, true, true);
$air_num_net = new \Korba\Amount("test");
$group_menu = new \Korba\ViewGroup([$menu, $air_num_net]);

$collection = new \Korba\Collection(["menu" => $menu,"submenu" => $submenu, "group" => $group_menu]);
$service = new \Korba\Services();

//echo $air_num_net->parseToString();
//echo $group_menu->getView(3)->parseToString();
//echo $collection->getCurrentView("group", 1)->parseToString();
echo $service->getCurrentView(strtoupper('korba_menu'),1)->parseToString();
