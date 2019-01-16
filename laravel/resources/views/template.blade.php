<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{$title}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="./css/main.css">

@yield('css')

</head>

<body>
  <header>
    <div id="banner"></div>
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
</body>
</html>