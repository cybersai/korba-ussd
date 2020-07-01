<?php

require_once 'vendor/autoload.php';

$exhange = new \Korba\XChangeV1(
    'e92129a3eaad9b75304b5fc9bb711d8b7cc44183db0f059ea996729dbfc6fd6e',
    '4c7a85b6211f857d3f9eb8a07fb0345449c2f582',
    '20',
    'test'
);
// $res = $exhange->surfline_final_bundles('0255000102');
$res = $exhange->new_etransact_validate('7022372904', 'DSTV', \Korba\Util::random());
echo json_encode($res);