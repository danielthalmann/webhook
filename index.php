<?php

$req_dump = print_r($_REQUEST, true);
$fp = fopen('request.log', 'a');
fwrite($fp, $req_dump);
fclose($fp);
