<?php
/*
* Copyright (c) Flagrow
* Copyright (c) 2017 Yixuan Qiu
*/

use Cosname\Listener;
use Illuminate\Contracts\Events\Dispatcher;

return function (Dispatcher $events) {
    $events->subscribe(Listener\AddKatexAssets::class);
    $events->subscribe(Listener\FindLatexExpressions::class);
};
