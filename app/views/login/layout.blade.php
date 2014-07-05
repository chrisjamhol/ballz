<!DOCTYPE HTML>
<!--
	Striped 2.5 by HTML5 Up!
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700|Open+Sans+Condensed:300,700" rel="stylesheet" />
		{{ HTML::script( asset('js/jquery.min.js') ) }}
		{{ HTML::script( asset('js/skel.min.js') ) }}
		{{ HTML::script( asset('js/skel-panels.min.js') ) }}
		{{ HTML::script( asset('js/init.js') ) }}
		<noscript>
			<!--{{ HTML::style( asset('css/skel-noscript.css') ) }}
			{{ HTML::style( asset('css/style.css') ) }}
			{{ HTML::style( asset('css/style-desktop.css') ) }}
			{{ HTML::style( asset('css/style-wide.css') ) }}-->
			<link rel="stylesheet" href="css/style.css" />
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="{{asset('css/ie9.css')}}" /><![endif]-->
		<!--[if lte IE 8]><script src="{{asset('js/html5shiv.js')}}"></script><link rel="stylesheet" href="{{asset('css/ie8.css')}}" /><![endif]-->
		<!--[if lte IE 7]><link rel="stylesheet" href="{{asset('css/ie7.css')}}" /><![endif]-->
		{{ HTML::style( asset('css/base.css') ) }}		
		{{HTML::style(asset('css/login/login.css'))}}
	</head>

  <body class="login">
  	<div id="wrapper">
  		@yield('loginContent')
  	</div>  	   
  </body>
</html>