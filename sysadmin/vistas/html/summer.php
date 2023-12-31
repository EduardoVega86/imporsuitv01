<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Summernote - Super Simple WYSIWYG editor</title>
<meta name="description" content="Super Simple WYSIWYG Editor on Bootstrap Summernote is a JavaScript library that helps you create WYSIWYG editors online.
">
<meta name="author" content="https://github.com/summernote">
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?">
<link rel="apple-touch-icon" sizes="57x57" href="/img/icons/icon_ios_57x57.png">
<link rel="apple-touch-icon" sizes="76x76" href="/img/icons/icon_ios_76x76.png">
<link rel="apple-touch-icon" sizes="120x120" href="/img/icons/icon_ios_120x120.png">
<link rel="apple-touch-icon" sizes="152x152" href="/img/icons/icon_ios_152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/img/icons/icon_ios_180x180.png">
<link rel="icon" type="image/png" sizes="192x192" href="/img/icons/android_icon_192x192.png">
<meta property="og:site_name" content="Summernote - Super Simple WYSIWYG editor">
<meta property="og:type" content="website">
<meta property="og:title" content="Summernote - Super Simple WYSIWYG editor">
<meta property="og:url" content="https://summernote.org/">
<meta property="og:image" content="/img/icons/1200x630.png">
<meta property="og:description" content="Super Simple WYSIWYG Editor on Bootstrap Summernote is a JavaScript library that helps you create WYSIWYG editors online.
">
<meta name="twitter:card" content="summary">
<meta name="twitter:url" content="https://summernote.org/">
<meta name="twitter:title" content="Summernote - Super Simple WYSIWYG editor">
<meta name="twitter:description" content="Super Simple WYSIWYG Editor on Bootstrap Summernote is a JavaScript library that helps you create WYSIWYG editors online.
">
<meta name="twitter:image" content="/img/icons/icon_200x200.png">
<meta name="twitter:site" content="@hackerwins">
<meta name="twitter:domain" content="https://summernote.org/">

<link rel="canonical" href="https://summernote.org/">
<link rel="alternate" type="application/rss+xml" title="Summernote - Super Simple WYSIWYG editor" href="https://summernote.org/feed.xml" />

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
<![endif]-->

<!-- jquery, bootstrap -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- codemirror -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/theme/blackboard.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/theme/monokai.min.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/mode/xml/xml.min.js"></script>

<!-- add summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-ko-KR.min.js"></script>

<!-- for website -->
<script src="/js/toc.js"></script>
<script src="/js/sidebar.js"></script>

<!-- Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-42438082-1', 'auto');
  ga('send', 'pageview');
</script>

    <link rel="stylesheet" href="/css/main.css">
  </head>

  <body class="page index">
    <header class="navbar navbar-default navbar-fixed-top fix-navbar" role="navigation">
  <div class="page-container header-page-container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand fix-header-brand header-bi" href="/"><span class="ir">summernote</span></a>
      <a href="https://github.com/summernote/summernote/archive/master.zip" id="download">
        <span class="img-mobile-download"></span>
      </a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        
          
          <li><a class="header-page-link" href="/getting-started/">Getting started</a></li>
          
        
          
          <li><a class="header-page-link" href="/deep-dive/">Deep dive</a></li>
          
        
          
          <li><a class="header-page-link" href="/examples/">Examples</a></li>
          
        
          
          <li><a class="header-page-link" href="/plugins">Plugins</a></li>
          
        
          
          <li><a class="header-page-link" href="/team/">Team</a></li>
          
        
          
        
          
        
          
        
          
        
      </ul>
      <ul class="nav navbar-nav navbar-right header-social">
        <li><a href="https://twitter.com/intent/tweet?button_hashtag=summernote" class="twitter">#summernote</a></li>
        <li><a href="https://github.com/summernote/summernote/" class="github">0,000</a></li>
      </ul>
    </div>
  </div>
</header>

    
    <div class="page-content">
  <div class="index-main-background"></div>

<div class="container">
  <h1 class="text-center index-title">
    <span class="img-index-title"></span>
    <span class="img-index-title-mobile">Super Simple WYSIWYG<br>Editor on Bootstrap</span>
    <a href="https://github.com/summernote/summernote/releases/download/v0.8.18/summernote-0.8.18-dist.zip" class="index-download">
      <span class="img-index-download"></span>
    </a>
  </h1>
</div>

<div class="page-container index-section-1">
  <div id="summernote"><p><br></p></div>
  <div class="placeholder">
    hi,<br>
    we are summernote.<br>
    please, write text here!<br>
    super simple WYSIWYG editor on Bootstrap
  </div>
  <div class="row card-list">
    <div class="card-arrow"></div>
    <div class="card-list-inner">
      <div class="card-item">
        <a href="/getting-started/#installation">
          <span class="img-index-install"></span>
          <h3 class="card-title">Easy to Install</h3>
          <p class="card-body">Simply download and attach your js, css with bootstrap. </p>
        </a>
      </div>
      <div class="card-item">
        <a href="/deep-dive/#customization">
          <span class="img-index-customizing"></span>
          <h3 class="card-title">Customization</h3>
          <p class="card-body">Customize by Initializing various options and modules.<br></p>
        </a>
      </div>
      <div class="card-item">
        <a href="/examples">
          <span class="img-index-shortcuts"></span>
          <h3 class="card-title">Examples</h3>
          <p class="card-body">See all useful features of summernote in action.</p>
        </a>
      </div>
      <div class="card-item">
        <a href="https://github.com/summernote/summernote">
          <span class="img-index-opensource"></span>
          <h3 class="card-title">Open Source</h3>
          <p class="card-body">Summernote is licensed under MIT and maintained by the community.</p>
        </a>
      </div>
      <div class="card-item">
        <a href="/getting-started/#integration">
          <span class="img-index-backend"></span>
          <h3 class="card-title">Integration</h3>
          <p class="card-body">Integrate it with any back-end. 3rd parties available in django, rails, angular.</p>
        </a>
      </div>
    </div>
  </div>
</div>

<div class="index-section-2">
  <div class="page-container">
    <div class="row">
      <div class="col-sm-5 summary-section">
        <h3>Features</h3>
        <ul style="list-style:none;padding:0;">
          <li>Supports Bootstrap 3.x.x to 5.x.x</li>
          <li>Lightweight (js+css: 100Kb)</li>
          <li>Smart User Interaction</li>
          <li>Works in all Major Browsers:
            <ul style="list-style:none;padding:0 10px 0 0;">
              <li>Safari, Chrome, Firefox, Opera, Edge and Internet Explorer 9+</li>
            </ul>
          </li>
          <li>Works in all Major Operating Systems:
            <ul style="list-style:none;padding:0 10px 0 0;">
              <li>Windows, MacOS, Linux</li>
            </ul>
          </li>
        </ul>
        <h3>Donate</h3>
        <div class="row">
          <div class="col-sm-12" >
            <div>
              <a href="https://opencollective.com/summernote#backers" target="_blank"><img src="https://opencollective.com/summernote/backers.svg?width=890"></a>
            </div>
          </div>
        </div>
        <h3>Ad</h3>
        <div class="row">
          <div class="col-sm-12 ad-section">
            <!-- Browserstack -->
<div class="ad">
  <a href="https://www.browserstack.com/">
    <img src="/img/vendor/browserstack.png" alt="We're testing Summernote via BrowserStack."/>
    <p>We're using BrowserStack for testing!</p>
  </a>
</div>
<!-- Google Ad -->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- ad-main -->
<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:100px"
     data-ad-client="ca-pub-4799203991210529"
     data-ad-slot="5651631492"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

          </div>
        </div>
      </div>
      <div class="col-sm-7 twitter-list">
        <h3 class="twitter-title">Much appreciate to all contributors! Together and further...</h3>
        <a href="https://github.com/summernote/summernote/graphs/contributors">Contributors</a>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(function() {
  // index page card list
  if ($('.card-list').length) {
    var $cardArrow = $('.card-arrow');
    var $cardListInner = $('.card-list-inner');

    $cardListInner.scroll(function () {
      $cardArrow.addClass('disappear');
      if ($cardListInner.scrollLeft() < 20) {
        $cardArrow.removeClass('disappear');
      }
    });
  }

  // main summernote with custom placeholder
  var $placeholder = $('.placeholder');
  $('#summernote').summernote({
    height: 300,
    codemirror: {
      mode: 'text/html',
      htmlMode: true,
      lineNumbers: true,
      theme: 'monokai'
    },
    callbacks: {
      onInit: function() {
        $placeholder.show();
      },
      onFocus: function() {
        $placeholder.hide();
      },
      onBlur: function() {
        var $self = $(this);
        setTimeout(function() {
          if ($self.summernote('isEmpty') && !$self.summernote('codeview.isActivated')) {
            $placeholder.show();
          }
        }, 300);
      }
    }
  });
});
</script>

</div>

<footer class="page-footer">
  <p>
  Summernote v0.8.18 · Created and Maintained by <a href="https://github.com/summernote">Summernote team</a>.<br>Based on <a href="http://getbootstrap.com">Bootstrap</a> and <a href="http://jquery.com">jQuery</a>.<br>Summernote distributed under the MIT license.</p>
<p><a href="https://github.com/summernote/summernote">GitHub Project</a> · <a href="https://github.com/summernote/summernote/issues">Issues</a> · <a href="https://communityinviter.com/apps/summernote/summernote">Slack</a> · <a href="https://stackoverflow.com/search?q=summernote">Stackoverflow</a></p>
<script>
  if (localStorage && localStorage.getItem && localStorage.getItem('github_expire') && localStorage.getItem('github_expire')>(new Date()).getTime()) {
    $('.github').text((+localStorage.getItem('github_star')).toLocaleString());
  } else {
    $.getJSON('https://api.github.com/repos/summernote/summernote',function(d) {
      if (localStorage && localStorage.setItem) {
        localStorage.setItem('github_star', d.stargazers_count);
        localStorage.setItem('github_expire', (new Date()).getTime()+(10*60*1000)/*10 mins*/);
      }
      $('.github').text(d.stargazers_count.toLocaleString());
    }).fail(function() {
      if (localStorage && localStorage.getItem && localStorage.getItem('github_star')) {
        $('.github').text(localStorage.getItem('github_star').toLocaleString());
      }
    });
  }
</script>

</footer>

  </body>
</html>
