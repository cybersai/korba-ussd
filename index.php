<?php

use Korba\SMS;

require 'vendor/autoload.php';

$sms = new SMS('https://gndvj.api.infobip.com', 'GaRuralBank','Test@12345', 'KorbaSMBTest');

print_r($sms->send('Hello welcome to smb', ['0545112466', '0509460180', '0503369866']));
