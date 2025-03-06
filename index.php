<?php

$payload = json_decode($_POST['payload'], true);
json_encode($payload, JSON_PRETTY_PRINT)

$fp = fopen('request.txt', 'w');
fwrite($fp, json_encode($payload, JSON_PRETTY_PRINT));
fclose($fp);
chmod('request.txt', 0666);
 