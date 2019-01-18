<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{$title}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="icon" href="https://ecole-ingenieurs.cesi.fr/wp-content/uploads/sites/5/2018/10/cropped-icone-cesi-ecole-ingenieurs-32x32.png">
	<link rel="stylesheet" type="text/css" href="./css/main.css">

@yield('css')
</head>

<body>
  <header>
    <div id="banner"> @if (!$logged)
    <a id="connexion" href="">Connexion</a>
    @else
    <p id="hello" href="">Bonjour Utilisateur!</p>
    @endif
    </div>

  </header>
    <aside class="sidebar">
      <div id="logo"></div>
        <a href="#Shop">Boutique</a>
        <a href="#Ideas">Boîte à Idées</a>
        <a href="#event">Évènement</a>
    </aside>
    <main>
      @yield('content')
    </main>
    <footer>
      <p> Mentions Légales: <br> Voici les mestions légales.<br>À completer.<p>
    </footer>
    <script type="text/javascript" src="./js/boutonHello.js"></script>
</body>
</html>
