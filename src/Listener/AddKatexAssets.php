<?php
/*
* Copyright (c) Flagrow
* Copyright (c) 2017 Yixuan Qiu
*/

namespace Cosname\Listener;

use Flarum\Event\ConfigureWebApp;
use Illuminate\Contracts\Events\Dispatcher;

class AddKatexAssets
{
    /**
     * Subscribes to the Flarum events.
     *
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureWebApp::class, [$this, 'addForumAssets']);
    }

    /**
     * Add forum assets.
     *
     * @param ConfigureWebApp $event
     */
    public function addForumAssets(ConfigureWebApp $event)
    {
        if ($event->isForum()) {
            $event->addAssets([
                __DIR__.'/../../js/forum/dist/extension.js'
            ]);
            // Include css and script for KaTeX
            $event->view->addHeadString('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.8.1/katex.min.css" integrity="sha384-BDqcjN11/6D69oC63ObubLHNvQR2fNjin6+AzxA3xalB0swTj17TxVV1tL1Q5Png" crossorigin="anonymous">', 'katex-css');
            $event->view->addHeadString('<script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.8.1/katex.min.js" integrity="sha384-sKYm5us3z9/bRQA+cc3gPzqwI5RVgL8vJQx1lpBudr9IzHOR8fnFUH68dz1GsTQw" crossorigin="anonymous"></script>', 'katex-js');
            $event->view->addHeadString('<script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.8.1/contrib/auto-render.min.js" integrity="sha384-RkgGHBDdR8eyBOoWeZ/vpGg1cOvSAJRflCUDACusAAIVwkwPrOUYykglPeqWakZu" crossorigin="anonymous"></script>', 'katex-autorender');

            $event->addBootstrapper('cosname/katex/main');
        }
    }
}
