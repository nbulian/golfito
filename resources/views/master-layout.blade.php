<!DOCTYPE html>
<html lang="es">
<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex">
  <meta name="googlebot-news" content="noindex" />
  <meta name="googlebot-news" content="nosnippet">
  <link rel="shortcut icon" href="{{ URL('favicon.ico') }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="{{ URL('src/js/admin.js') }}"></script>
  @yield('headscript')
  <style>
    header {
      background-image: url("bg.jpg");
      background-position: 42% 0;
      background-repeat: no-repeat;
      background-size: cover;
      bottom: 0;
      left: 0;
      position: absolute;
      right: 0;
      top: 0;
    }
  </style>
</head>
<body>

@yield('header')

<div class="container-fluid" id="content">
    @yield('container')
</div>

<div id="loading" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">
	<div class="modal-dialog modal-m">
	<div class="modal-content">
		<div class="modal-header"><h3 style="margin:0;">Loading...</h3></div>
		<div class="modal-body">
			<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>
		</div>
	</div></div>
</div>

@yield('footerscript')

<footer class="container-fluid text-center" style="padding-top: 50px;">
  <p>Mini Golf League</p> 
  <p>Golfito Tour {{ date('Y') }}</p> 
</footer>

</body>
</html>