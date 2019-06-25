<?php

use Korba\XChangeV1;

require 'vendor/autoload.php';




$tracker = new stdClass();
//$tracker->payload = json_encode(['number' => '0255125984']);
$tracker->payload = json_encode(['number' => '157894']);
$tracker->type = 'dstv';
$tracker->authorization = 'registered';
$tracker->phone_number = '+233545112466';
$tracker->network = 'MTN';
$tracker->transaction_id = '12335341334123';
$input = '7022372904';
$target = '1';
$option = 'KORBA_UTIL_NUM';

$response = \Korba\ExampleServiceScript::copyMe($tracker, $input, $target, strtoupper($option));
echo $response->parseToString()."<br>";
echo $response->getNext()."<br>";

$xchange = new XChangeV1('fd2f9df0d6876e88c6e81f7a4748c90c207ebb497bd4822ef689628b0045743b', '457b43b4e30a0be7c94fb0544ba3e10d3b900fff', '9');
echo json_encode($xchange->etransact_validate('715445076', 'ECG', \Korba\Util::random()))."<br>";
echo json_encode($xchange->gwcl_lookup('0277751590', '020510775041', \Korba\Util::random()));
