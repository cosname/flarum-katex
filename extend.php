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
                    '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.11.1/katex.min.css" integrity="sha256-V8SV2MO1FUb63Bwht5Wx9x6PVHNa02gv8BgH/uH3ung=" crossorigin="anonymous" />',
                    '<script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.11.1/katex.min.js" integrity="sha256-F/Xda58SPdcUCr+xhSGz9MA2zQBPb0ASEYKohl8UCHc=" crossorigin="anonymous"></script>',
                    '<script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.11.1/contrib/auto-render.min.js" integrity="sha256-90d2pnfw0r4K8CZAWPko4rpFXQsZvJhTBGYNkipDprI=" crossorigin="anonymous"></script>'
                ]
            );
        }),
    
    // Add listener
    function (Dispatcher $events) {
        $events->subscribe(Listener\FindLatexExpressions::class);
    }
];
