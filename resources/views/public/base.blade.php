<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>FLEX BOX SOLUTIONS</title>
	<link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" media="screen" href="https://cdn.rawgit.com/resir014/Clear-Sans-Webfont/v1.1.1/css/clear-sans.css">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600,800,900" rel="stylesheet" type="text/css">
	<style type="text/css">
		body{
	        font-family: "Clear Sans", "Helvetica Neue","sans-serif";
	        -moz-osx-font-smoothing: grayscale;
	        -webkit-font-smoothing: antialiased;
	        text-rendering: optimizeLegibility;
	    }
	</style>
	<script src="{{ mix('/js/app.js') }}"></script>
	@yield('head')
</head>
<body>
@yield('content')
@yield('script')
</body>
</html>