(()=>{var e={n:t=>{var o=t&&t.__esModule?()=>t.default:()=>t;return e.d(o,{a:o}),o},d:(t,o)=>{for(var i in o)e.o(o,i)&&!e.o(t,i)&&Object.defineProperty(t,i,{enumerable:!0,get:o[i]})},o:(e,t)=>Object.prototype.hasOwnProperty.call(e,t),r:e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})}},t={};(()=>{"use strict";e.r(t);const o=flarum.core.compat.extend,i=flarum.core.compat["components/CommentPost"];var r=e.n(i);const n=flarum.core.compat["components/TextEditor"];var a=e.n(n);app.initializers.add("cosname-katex",(function(){(0,o.extend)(r().prototype,"oncreate",(function(){$("code.katex-escape",this.element).each((function(){$(this).replaceWith($(this).html())})),renderMathInElement($("div.Post-body",this.element)[0],{ignoredTags:["script","noscript","style","textarea","pre","code"],delimiters:[{left:"$$",right:"$$",display:!0},{left:"\\[",right:"\\]",display:!0},{left:"\\(",right:"\\)",display:!1}]})})),(0,o.extend)(r().prototype,"onupdate",(function(){$("code.katex-escape",this.element).each((function(){$(this).replaceWith($(this).html())})),renderMathInElement($("div.Post-body",this.element)[0],{ignoredTags:["script","noscript","style","textarea","pre","code"],delimiters:[{left:"$$",right:"$$",display:!0},{left:"\\[",right:"\\]",display:!0},{left:"\\(",right:"\\)",display:!1}]})})),(0,o.extend)(a().prototype,"oninit",(function(){for(var e=this.value,t='<code class="katex-escape">',o=t.length,i="</code>",r=i.length,n=e.indexOf(t);n>=0;){var a=(e=e.slice(0,n)+e.slice(n+o)).indexOf(i);a>=0&&(e=e.slice(0,a)+e.slice(a+r)),n=e.indexOf(t)}this.value=e}))}))})(),module.exports=t})();
//# sourceMappingURL=forum.js.map