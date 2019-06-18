<?php

use Korba\XChangeV1;

require 'vendor/autoload.php';




//$verify = new Verify();
//$pverify = new VerifyP();
//$tracker = new stdClass();
//$tracker->payload = json_encode(['network' => 'GLO', ]);
//$tracker->network = 'VOD';
//$tracker->type = 'own';
//$tracker->authorization = 'non-registered';
//$input = '0545112466';
//$option = 'korba_airtime_num_confirm';
//$service = new \Korba\Services($pverify);
//$service->canProcess($tracker, $input, strtoupper($option));
//$response = $service->getCurrentView(strtoupper($option), $input);
//$response->canManipulate($tracker, $input);
//echo "<br>".$response->parseToString()."<br>";
//print_r($tracker);
//echo "<br>".$response->getNext();
$tracker = new stdClass();
//$tracker->payload = json_encode(['number' => '0255125984']);
$tracker->payload = json_encode(['number' => '157894']);
$tracker->type = 'mtn_fibre';
$tracker->authorization = 'registered';
$tracker->phone_number = '+233545112466';
$tracker->network = 'MTN';
$input = '2';
$target = '1';
$option = 'KORBA_DATA_CONFIRMATION';

$response = \Korba\ExampleServiceScript::copyMe($tracker, $input, $target, strtoupper($option));
echo $response->parseToString()."<br>";
echo $response->getNext()."<br>";

$xchange = new XChangeV1('fd2f9df0d6876e88c6e81f7a4748c90c207ebb497bd4822ef689628b0045743b', '457b43b4e30a0be7c94fb0544ba3e10d3b900fff', '9');
echo \Korba\Util::verifyWholeNumber('1') ? "True" : "False";
