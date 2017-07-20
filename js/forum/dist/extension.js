'use strict';

System.register('cosname/katex/main', ['flarum/extend', 'flarum/components/CommentPost', 'flarum/components/TextEditor'], function (_export, _context) {
  "use strict";

  var extend, CommentPost, TextEditor;
  return {
    setters: [function (_flarumExtend) {
      extend = _flarumExtend.extend;
    }, function (_flarumComponentsCommentPost) {
      CommentPost = _flarumComponentsCommentPost.default;
    }, function (_flarumComponentsTextEditor) {
      TextEditor = _flarumComponentsTextEditor.default;
    }],
    execute: function () {

      app.initializers.add('cosname-katex', function () {
        // render math expression on every post loading
        extend(CommentPost.prototype, 'config', function () {

          // remove the <code> tags that enclose KaTeX
          // (we added <code class="katex-escape"> tags on LaTeX expressions when saving the post)
          var katex_expr = $('code.katex-escape', this.element);
          katex_expr.each(function () {
            $(this).replaceWith($(this).html());
          });

          // run KaTeX renderer on the single post body (not on the entire page or the entire post)
          renderMathInElement($('div.Post-body', this.element)[0], {
            // do not render inside those tags
            "ignoredTags": ["script", "noscript", "style", "textarea", "pre", "code"],
            // those are the delimiters we are going to use to write latex formulas
            "delimiters": [{ left: "$$", right: "$$", display: true }, { left: "\\[", right: "\\]", display: true }, { left: "\\(", right: "\\)", display: false }]
          });
        });

        // remove the <code class="katex-escape"> tags in editor
        extend(TextEditor.prototype, 'init', function () {

          // get the current text
          var text = this.value();
          var tag1 = '<code class="katex-escape">';
          var len1 = tag1.length;
          var tag2 = '</code>';
          var len2 = tag2.length;

          var i = text.indexOf(tag1);
          // recursively remove tags
          while (i > 0) {
            text = text.slice(0, i) + text.slice(i + len1);
            var j = text.indexOf(tag2);
            if (j > 0) text = text.slice(0, j) + text.slice(j + len2);
            i = text.indexOf(tag1);
          }
          this.value(text);
        });
      });
    }
  };
});