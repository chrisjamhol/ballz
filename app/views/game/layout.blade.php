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
    {{HTML::style(asset('css/games/userGames.css'))}}
</head>

<body class="left-sidebar">
    <div id="wrapper">
        <div id="content">
            <div id="content-inner">
                <h1>Ballz - Game of Balls</h1>
                @yield('gameContent')
            </div>
        </div>
        <div id="sidebar">
            <div id="logo">
                <h1>Ballz!</h1>
            </div>
            <nav id="nav">
                @yield('nav')
            </nav>
        </div>
    </div>
</body>
</html>