!function(e,t,o,n){function a(e,t){return e[t]===n?m[t]:e[t]}function r(){var e=t.pageYOffset;return e===n?v.scrollTop:e}function i(e,t){var o=m["on"+e];o&&(p(o)?o.call(t[0]):(o.addClass&&t.addClass(o.addClass),o.removeClass&&t.removeClass(o.removeClass))),t.trigger("lazy"+e,[t]),c()}function l(t){i(t.type,e(this).off(h,l))}function d(o){if(b.length){o=o||m.forceLoad,E=1/0;var n,a,d=r(),s=t.innerHeight||v.clientHeight,c=t.innerWidth||v.clientWidth;for(n=0,a=b.length;n<a;n++){var u,f=b[n],y=f[0],w=f[g],z=!1,T=o||C(y,A)<0;if(e.contains(v,y)){if(o||!w.visibleOnly||y.offsetWidth||y.offsetHeight){if(!T){var I=y.getBoundingClientRect(),L=w.edgeX,B=w.edgeY;T=(u=I.top+d-B-s)<=d&&I.bottom>-B&&I.left<=c+L&&I.right>-L}if(T){f.on(h,l),i("show",f);var X=w.srcAttr,k=p(X)?X(f):y.getAttribute(X);k&&(y.src=k),z=!0}else u<E&&(E=u)}}else z=!0;z&&(C(y,A,0),b.splice(n--,1),a--)}a||i("complete",e(v))}}function s(){T>1?(T=1,d(),setTimeout(s,m.throttle)):T=0}function c(e){b.length&&(e&&"scroll"===e.type&&e.currentTarget===t&&E>=r()||(T||setTimeout(s,0),T=2))}function u(){w.lazyLoadXT()}function f(){d(!0)}var g="lazyLoadXT",A="lazied",h="load error",v=o.documentElement||o.body,m={autoInit:!0,selector:"img[data-src]",blankImage:"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7",throttle:99,forceLoad:t.onscroll===n||!!t.operamini||!v.getBoundingClientRect,loadEvent:"pageshow",updateEvent:"load orientationchange resize scroll touchmove focus",forceEvent:"lazyloadall",oninit:{removeClass:"lazy"},onshow:{addClass:"lazy-hidden"},onload:{removeClass:"lazy-hidden",addClass:"lazy-loaded"},onerror:{removeClass:"lazy-hidden"},checkDuplicates:!0},y={srcAttr:"data-src",edgeX:0,edgeY:0,visibleOnly:!0},w=e(t),p=e.isFunction,z=e.extend,C=e.data||function(t,o){return e(t).data(o)},b=[],E=0,T=0;e[g]=z(m,y,e[g]),e.fn[g]=function(o){var n,r=a(o=o||{},"blankImage"),l=a(o,"checkDuplicates"),d=a(o,"scrollContainer"),s=a(o,"show"),u={};e(d).on("scroll",c);for(n in y)u[n]=a(o,n);return this.each(function(n,a){if(a===t)e(m.selector).lazyLoadXT(o);else{var d=l&&C(a,A),f=e(a).data(A,s?-1:1);if(d)return void c();r&&"IMG"===a.tagName&&!a.src&&(a.src=r),f[g]=z({},u),i("init",f),b.push(f),c()}})},e(o).ready(function(){i("start",w),w.on(m.updateEvent,c).on(m.forceEvent,f),e(o).on(m.updateEvent,c),m.autoInit&&(w.on(m.loadEvent,u),u())})}(window.jQuery||window.Zepto||window.$,window,document),function(e){var t=e.lazyLoadXT,o=t.bgAttr||"data-bg";t.selector+=",["+o+"]",e(document).on("lazyshow",function(t){var n=e(t.target),a=n.attr(o);a&&n.css("background-image","url('"+a+"')").removeAttr(o).triggerHandler("load")})}(window.jQuery||window.Zepto||window.$);