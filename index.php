<?php

$req_dump = print_r($_REQUEST, true);
$post_dump = print_r($_POST, true);
$get_dump = print_r($_GET, true);
//unlink('request.log');
$fp = fopen('request.txt', 'a');
fwrite($fp, $req_dump);
fwrite($fp, $post_dump);
fwrite($fp, $get_dump);
fclose($fp);
chmod('request.txt', 0666);
