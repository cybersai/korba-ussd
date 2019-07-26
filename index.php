<?php

use Korba\SMS;

require 'vendor/autoload.php';

$sms = new SMS('https://gndvj.api.infobip.com', 'GaRuralBank','Test@12345', 'KorbaSMB');

print_r($sms->send('Hello welcome to smb', '0545112466'));
