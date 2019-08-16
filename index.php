<?php

use Korba\SMS;

require 'vendor/autoload.php';

$x_change = new \Korba\XChangeV1('fd2f9df0d6876e88c6e81f7a4748c90c207ebb497bd4822ef689628b0045743b',
    '457b43b4e30a0be7c94fb0544ba3e10d3b900fff','9');

print_r($x_change->etransact_validate('701879073', 'DSTV', \Korba\Util::random()));
