<?php

use Flarum\Extend;
use Flarum\Frontend\Document;
use Cosname\Listener;
use Illuminate\Contracts\Events\Dispatcher;

return [
    // Load JS script
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js'),

    // Add CSS and JS resources
    (new Extend\Frontend('forum'))
        ->content(function (Document $document) {
            $document->head = array_merge($document->head,
                [
                    '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.10.2/katex.min.css" integrity="sha256-uT5rNa8r/qorzlARiO7fTBE7EWQiX/umLlXsq7zyQP8=" crossorigin="anonymous" />',
                    '<script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.10.2/katex.min.js" integrity="sha256-TxnaXkPUeemXTVhlS5tDIVg42AvnNAotNaQjjYKK9bc=" crossorigin="anonymous"></script>',
                    '<script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.10.2/contrib/auto-render.min.js" integrity="sha256-90d2pnfw0r4K8CZAWPko4rpFXQsZvJhTBGYNkipDprI=" crossorigin="anonymous"></script>'
                ]
            );
        }),
    
    // Add listener
    function (Dispatcher $events) {
        $events->subscribe(Listener\FindLatexExpressions::class);
    }
];
