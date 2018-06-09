<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pic Store</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="{!! asset('css/app.css') !!}" media="all" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                  <a class="navbar-brand" href="/">Pic Store</a>
                </div>
                <ul class="nav navbar-nav">
                    <li {{{ (Request::is('formpic') ? 'class=active' : '') }}}>
                        <a href="/form/pic">Ajouter une image</a>
                    </li>
                </ul>
            </div>
            </nav>
			@yield('contenu')
		</div>        
    </body>
</html>
