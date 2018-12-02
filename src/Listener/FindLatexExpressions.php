<?php
/*
* Copyright (c) Flagrow
* Copyright (c) 2017-2018 Yixuan Qiu
*/

namespace Cosname\Listener;

use Flarum\Post\Event\Saving;
use Illuminate\Contracts\Events\Dispatcher;

class FindLatexExpressions
{
    /**
     * Subscribes to the Flarum events.
     *
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(Saving::class, [$this, 'findExpressions']);
    }

    /**
     * This function searches for LaTeX expressions, delimited by \(\), \[\], or $$.
     * It then adds special <code> tags around the expression, so that is does not
     * get modifed by Markdown or BBcode.
     *
     * @param Saving $event
     */
    public function findExpressions(Saving $event)
    {
        // Get the text from the post, comment, or answer
        $text = $event->post->content;
        // Matching $$...$$. To check what it does use regex101.com
        $regex = '/(?<!\\\\)(?: ((?<!\\$)(?<!\\`)(?<!\\`\\n)(?<!>)\\$\\$(?!\\n\\`)(?!\\`)(?!\\$)))(.*(?R)?.*)(?<!\\\\)(?: ((?<!\\$)(?<!\\`)(?<!\\`\\n)\\1(?!\\n\\`)(?!\\`)(?!\\$)(?!<)))/mxU';
        $text = preg_replace($regex, '<code class="katex-escape">\\1\\2\\3</code>', $text);
        // Matching \(...\)
        $regex = '/(?<!\\\\)(?: ((?<!\\$)(?<!\\`)(?<!\\`\\n)(?<!>)\\\\\\((?!\\n\\`)(?!\\`)(?!\\$)))(.*(?R)?.*)(?<!\\\\)(?: ((?<!\\$)(?<!\\`)(?<!\\`\\n)\\\\\\)(?!\\n\\`)(?!\\`)(?!\\$)(?!<)))/mxU';
        $text = preg_replace($regex, '<code class="katex-escape">\\1\\2\\3</code>', $text);
        // Matching \[...\]
        $regex = '/(?<!\\\\)(?: ((?<!\\$)(?<!\\`)(?<!\\`\\n)(?<!>)\\\\\\[(?!\\n\\`)(?!\\`)(?!\\$)))(.*(?R)?.*)(?<!\\\\)(?: ((?<!\\$)(?<!\\`)(?<!\\`\\n)\\\\\\](?!\\n\\`)(?!\\`)(?!\\$)(?!<)))/mxU';
        $text = preg_replace($regex, '<code class="katex-escape">\\1\\2\\3</code>', $text);
        // Edit the post content
        $event->post->content = $text;
    }
}
