<!DOCTYPE html>
<html lang="lt">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>

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
          <a href="{{route('homepage')}}" >
              <img src="{{url('logo1.svg')}}" />
            </a>
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
              @foreach($submenu as $k => $v)
                <li class="@if($itemtype == $k) active @endif" onclick="location='{{route('homepage',['itemtype' => $k])}}'; return false;"><a href="#">{{$v}}</a></li>
              @endforeach
                <li class="@if($sellaction ==2) active @endif"><a href="#"  onclick="location='{{route('homepage',['sellaction' => '2'])}}'; return false;">Nuoma</a></li>
              </ul>
            </div>
        
      </div>
      
      <div class="bottom">
        <h2>Raskite savo naujus namus su Alginos NT</h2>
        <form action="search" method="post" class="search-row">
          <input name="search" type="text" placeholder="Įveskite skelbimo ID arba adresą" />
          <img class="search_img" src="{{asset('assets/img/search-sm.svg')}}" onclick="submit(); return false;">
          <button class="button">Detali paieška<div><img id="white" src="{{asset('assets/img/chevron-down.svg')}}"><img id="black" src="{{asset('assets/img/chevron-down2.svg')}}"></div></button>
        </form>
      </div>
    </div>
  </header>

  <div class="search_block">
    <form action="{{route('homepage')}}" method="post" >
      @csrf
      <div class="content">
        <div class="column">
            <select name="floor_from">
              <option value="">Aukštas nuo</option>
              @foreach(range(1,100) as $v)
                <option value="{{$v}}">{{$v}}</option>
              @endforeach
            </select>
            <div class="from_to">
              Plotas 
              <input type="text" placeholder="nuo" name="area_from">
              <input type="text" placeholder="iki" name="area_to">
              m
            </div>
            <select name="itemType">
                <option value="">Tipas</option>
                @foreach($submenu as $key => $menu)
                  <option value="{{$key}}">{{$menu}}</option>
                @endforeach
            </select>
        </div>
        <div class="column">
            <select name="floor_to">
              <option value="">Aukštas iki</option>
              @foreach(range(1,100) as $v)
                <option value="{{$v}}">{{$v}}</option>
              @endforeach
            </select>
            <div class="from_to">
                Kaina 
              <input type="text" placeholder="nuo" name="price_from">
              <input type="text" placeholder="iki" name="price_to">
              &euro;
            </div>
            @include('MyComponents.select_heating')
        </div>
        <div class="column">
            <select name="roomAmount_from">
              <option value="">Kambariai nuo</option>
              @foreach(range(1,100) as $v)
                <option value="{{$v}}">{{$v}}</option>
              @endforeach
            </select>
            <select name="years_from">
              <option value="">Metai nuo</option>
              @foreach(range(1,100) as $v)
                <option value="{{$v}}">{{$v}}</option>
              @endforeach
            </select>
            @include('MyComponents.select_additional_equipment')
        </div>
        <div class="column">
            <select name="roomAmount_to">
              <option value="">Kambariai iki</option>
              @foreach(range(1,100) as $v)
                <option value="{{$v}}">{{$v}}</option>
              @endforeach
            </select>
            <select name="years_to">
              <option value="">Metai iki</option>
              @foreach(range(1,100) as $v)
                <option value="{{$v}}">{{$v}}</option>
              @endforeach
            </select>
            <label class="with_photos">
              <input type="checkbox" name="with_photos" /> Su nuotraukomis
            </label>
        </div>
      </div>
      <div class="button_search">
        <input type="submit" name="submit_search" value="Ieškoti" />
      </div>
      </form>
  </div>
  @yield('main')
  
  <div class="hero_bottom">
    <div class="background"></div>
    <div class="hero-content">
        <h2>Naujo būsto paieškos gali būti labai sudėtingos, todėl<br> patikėkite tai profesionalams.</h2>
        <div class="search-row">
          <button class="button">SIŲSTI UŽKLAUSĄ</button>
        </div>
    </dv>
  </div>
  </div>
  <footer class="footer">
    <div class="top">
      <div class="column">
        <img src="{{url('logo1.svg')}}" />
      </div>
      <div class="column">
        <h4>Butai</h4>
        <ul>
          <li><a href="#" >1 kambarių</a></li>
          <li><a href="#" >2 kambarių</a></li>
          <li><a href="#" >3 kambarių</a></li>
          <li><a href="#" >4 kambarių ir daugiau</a></li>
          <li><a href="#" >Naujos statybos</a></li>
          <li><a href="#" >Bendrabučiai</a></li>
        </ul>
      </div>
      <div class="column">
        <h4>Butai</h4>
        <ul>
          <li><a href="#" >1 kambarių</a></li>
          <li><a href="#" >2 kambarių</a></li>
          <li><a href="#" >3 kambarių</a></li>
          <li><a href="#" >4 kambarių ir daugiau</a></li>
          <li><a href="#" >Naujos statybos</a></li>
          <li><a href="#" >Bendrabučiai</a></li>
        </ul>
      </div>
      <div class="column">
        <h4>Butai</h4>
        <ul>
          <li><a href="#" >1 kambarių</a></li>
          <li><a href="#" >2 kambarių</a></li>
          <li><a href="#" >3 kambarių</a></li>
          <li><a href="#" >4 kambarių ir daugiau</a></li>
          <li><a href="#" >Naujos statybos</a></li>
          <li><a href="#" >Bendrabučiai</a></li>
        </ul>
      </div>
      <div class="column sert">
        <img src="{{url('image 4.png')}}" />
        <img src="{{url('image 5.png')}}" />
      </div>
    </div>
    <div class="bottom">
      <a>Privatumo politika</a>
      <div class="middle">
        <p>2025 AlginosNT. Visos teisės saugomos. Sprendimas:</p>
        <img src="{{url('satvos.png')}}" />
      </div>
      <div class="socials">
        <p>Sekite mus</p>
        <a href="#" target="_blank">
          <img src="{{url('Vector (3).png')}}" />
        </a>
        <a href="#" target="_blank">
          <img src="{{url('Social Icons.png')}}" />
        </a>
        <a href="#" target="_blank">
          <img src="{{url('Vector (4).png')}}" />
        </a>
      </div>
    </div>
  </footer>

    @stack('styles')
    @stack('scripts')

    <script>

        document.querySelector('.hero-content .bottom .button').addEventListener('click', function(e){
            e.preventDefault()
             if(this.classList.contains('active')){
                this.classList.remove('active')
                document.querySelector('.search_block').classList.remove('visible')
              }else{
               this.classList.add('active')
               document.querySelector('.search_block').classList.add('visible')
             }
                      
        })

    </script>

</body>
</html>
