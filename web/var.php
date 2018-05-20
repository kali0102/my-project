<?php

$client = new Swoole\Http\Client();
$client->on();


$redis = new \Swoole\Redis();