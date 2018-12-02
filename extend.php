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
            $document->head = [
                '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.10.0/katex.min.css" integrity="sha256-BZ71u1P7NUocEN9mKkcAovn3q5JPm/r9xVyjWh/Kqrc=" crossorigin="anonymous" />',
                '<script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.10.0/katex.min.js" integrity="sha256-q01RVaHUJiYq9aq0FwkI6GAmMtOmRgToK8aEHHm4Xl8=" crossorigin="anonymous"></script>',
                '<script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.10.0/contrib/auto-render.js" integrity="sha256-7ec4f0vWCV96kY2Ta/xZ2ry4V0daxW/eqQgA+63ORlY=" crossorigin="anonymous"></script>'
            ];
        }),
    
    // Add listener
    function (Dispatcher $events) {
        $events->subscribe(Listener\FindLatexExpressions::class);
    }
];
