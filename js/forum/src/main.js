import { extend } from 'flarum/extend';
import CommentPost from 'flarum/components/CommentPost';

app.initializers.add('cosname-katex', function() {
  // on every post loading
  extend(CommentPost.prototype, 'config', function() {

    // remove the <code> tags that enclose KaTeX
    // (we added <code class="katex-escape"> tags on LaTeX expressions when saving the post)
    var katex_expr = $('code.katex-escape', this.element);
    katex_expr.each(function() {
      $(this).replaceWith($(this).html());
    });

    // run KaTeX renderer on the single post body (not on the entire page or the entire post)
    renderMathInElement($('div.Post-body', this.element)[0], {
      // do not render inside those tags
      "ignoredTags":["script", "noscript", "style", "textarea", "pre", "code"],
      // those are the delimiters we are going to use to write latex formulas
      "delimiters":[
        {left: "$$", right: "$$", display: true},
        {left: "\\[", right: "\\]", display: true},
        {left: "\\(", right: "\\)", display: false}
      ]
    });

  });
});
