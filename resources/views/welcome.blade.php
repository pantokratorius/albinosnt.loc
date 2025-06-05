<!DOCTYPE html>
<html lang="lt">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Pagrindinis | Alginos NT</title>

  <link rel="start" title="Home Page, shortcut key=1" href="https://alginosnt.lt/">
  <meta property="og:url" content="http://alginosnt.lt">
	<meta property="og:type" content="website">
	<meta property="og:title" content="Pagrindinis">
	<meta property="og:description" content="Nekilnojamo turto agentūra">
	<meta property="og:image" content="{{url('logo.svg')}}">
  @vite(['resources/css/style.scss'])


</head>
<body>
  <header class="hero">
    <div class="background"></div>
    <div class="hero-content">
      <div class="top">
        <div class="left">
            <img src="{{url('logo1.svg')}}" />
        </div>
        <div class="right">
            <ul class="main_menu" >
                <li><a href="#">Nekilnajams turtas</a></li>
                <li><a href="#">Norintiems parduoti</a></li>
                <li><a href="#">Paslaugos</a></li>
                <li><a href="#">Partneriai</a></li>
                <li><a href="#">Kontaktai</a></li>
                <li class="langs">
                  <a class="active" href="#">LT</a>
                  <a href="#">RU</a>
                </li>
            </ul>
            <ul class="sub_menu" >
                <li class="active" ><a href="#">Butai</a></li>
                <li><a href="#">Namai Kotedžai</a></li>
                <li><a href="#">Sodybos</a></li>
                <li><a href="#">Sklypai</a></li>
                <li><a href="#">Sodai</a></li>
                <li><a href="#">Patalpos</a></li>
                <li><a href="#">Nuoma</a></li>
              </ul>
            </div>
      </div>
      <div class="bottom">
        <h1>Raskite savo naujus namus su Alginos NT</h1>
        <div class="search-row">
          <input name="search" type="text" placeholder="Įveskite skelbimo ID arba adresą" />
          <img class="search_img" src="{{asset('assets/img/search-sm.svg')}}">
          <button href="#learn-more" class="button">Detali paieška<img src="{{asset('assets/img/chevron-down.svg')}}"></button>
        </div>
      </div>
    </div>
  </header>
</body>
</html>
