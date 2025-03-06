<?php

const LOGFILE = 'request.txt';

$payload = json_decode($_POST['payload'] ?? '{}', true);
json_encode($payload, JSON_PRETTY_PRINT);

$fp = fopen(LOGFILE, 'w');
//fwrite($fp, json_encode($payload, JSON_PRETTY_PRINT));
ExecuteCmd('pwd', $fp);
ExecuteCmd('git fetch origin', $fp);
ExecuteCmd('git reset --hard origin/main', $fp);
ExecuteCmd('git remote -v', $fp);
ExecuteCmd('git remote set-url origin https://github.com/danielthalmann/webhook.git', $fp);
ExecuteCmd('git pull', $fp);

fclose($fp);
chmod(LOGFILE, 0666);

function ExecuteCmd($cmd, $fp)
{
    fwrite($fp, $cmd . "\n");
    exec($cmd, $output, $retval);
    //fwrite($fp, 'return : ' . $retval . "\n");
    if ($output) {
        foreach ($output as $line) {
            fwrite($fp, $line . "\n");
        }
    }
}