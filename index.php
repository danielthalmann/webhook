<?php

const LOGFILE = 'request.txt';

$payload = json_decode($_POST['payload'] ?? '{}', true);
json_encode($payload, JSON_PRETTY_PRINT);

$fp = fopen(LOGFILE, 'w');
fwrite($fp, json_encode($payload, JSON_PRETTY_PRINT));
ExecuteCmd('git remote set-url origin https://github.com/danielthalmann/webhook.git', $fp);
ExecuteCmd('git pull', $fp);
echo "Returned with status $retval and output:\n";
print_r($output);


fclose($fp);
chmod(LOGFILE, 0666);

function ExecuteCmd($cmd, $fp)
{
    fwrite($fp, $cmd . "\n");
    exec($cmd, $output, $retval);
    fwrite($fp, 'return : ' . $retval . "\n");
    if ($output) {
        foreach ($output as $line) {
            fwrite($fp, $line . "\n");
        }
    }
}