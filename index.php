<?php

use Korba\XChangeV1;

require 'vendor/autoload.php';

$exchange = new XChangeV1(
    'e92129a3eaad9b75304b5fc9bb711d8b7cc44183db0f059ea996729dbfc6fd6e',
    '4c7a85b6211f857d3f9eb8a07fb0345449c2f582',
    '20'
);

echo json_encode($exchange->new_vodafone_bundles());