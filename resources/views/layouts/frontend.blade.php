<!DOCTYPE html>
<html lang="lt">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>


  <link rel="icon" type="image/png" sizes="32x32" href="/favicon.png">

  <link rel="start" title="Home Page, shortcut key=1" href="https://alginosnt.lt/">
  <meta property="og:url" content="http://alginosnt.lt">
	<meta property="og:type" content="website">
	<meta property="og:title" content="Pagrindinis">
	<meta property="og:description" content="Nekilnojamo turto agentūra">
	<meta property="og:image" content="{{url('logo.svg')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite(['resources/css/style.scss'])


</head>
<body>
    <div class="overlay" id="popupOverlay" onclick="closePopup(event)">
      <div class="popup-form">
        <button class="close-btn">×</button>
        <h2>{{ __('string.Mūsų paslaugos') }}</h2>
        <form action="" method="post">
          @csrf
          <input type="tel" name="phone" placeholder="{{ __('string.Telefonas') }}*" required>
          <input type="email" name="email" placeholder="{{ __('string.El. paštas') }}">
          <textarea name="message" rows="2" placeholder="{{ __('string.Žinutė') }}" required></textarea>
          <div class="bottom">
            <span> </span>
            <span class="response_message"></span>
            <button type="submit" class="send">{{ __('string.Siųsti') }}</button>
          </div>
        </form>
      </div>
    </div>
  <header class="hero desktop">
    <div class="background"></div>
    <div class="hero-content">
      <div class="top">
        <div class="left">
          <a href="{{route(app()->getLocale() . '_' .'homepage')}}" >
              <img src="{{url('logo1.svg')}}" />
            </a>
        </div>
        <div class="right">
            <ul class="main_menu" >

                @foreach($main_menu as $k => $v)
                <li @if($active_main_menu_link == $k) class="active" @endif><a href="{{route(app()->getLocale() . '_' . $k)}}">{{__('main_menu.'. $v)}}</a></li>
            @endforeach
                <li class="langs">
                  <a @if(app()->getLocale() == 'lt') class="active"@endif href="{{ route('lang', ['locale'=>'lt']) }}">LT</a>
                  <a @if(app()->getLocale() == 'ru') class="active"@endif href="{{ route('lang', ['locale'=>'ru']) }}">RU</a>
                </li>
            </ul>
            <ul class="sub_menu" >
              @foreach($submenu as $k => $v)
                <li class="@if($itemtype == $k) active @endif" onclick="location='{{route(app()->getLocale() . '_itemtype', __('submenu.'.$k))}}'; return false;"><a href="#">{{__('submenu.' . $v)}}</a></li>
              @endforeach
                <li class="@if($sellaction ==2) active @endif"><a href="#"  onclick="location='{{route(app()->getLocale() . '_sellaction', 2)}}'; return false;">{{__('submenu.Nuoma') }}</a></li>
              </ul>
            </div>

      </div>

      <div class="bottom">
        <h2>{{__('string.hero_text') }}</h2>
        <form action="{{route('search')}}" method="post" class="search-row" id="search_id">
          @csrf
          <input name="search" type="text" placeholder="{{ __('string.search_placeholder') }}" />
          <img class="search_img" src="{{asset('assets/img/search-sm.svg')}}" onclick="submit(); return false;">
          <button class="button">{{ __('string.detailed') }}<div><img id="white" src="{{asset('assets/img/chevron-down.svg')}}"><img id="black" src="{{asset('assets/img/chevron-down2.svg')}}"></div></button>
        </form>
      </div>
    </div>
  </header>
  <header class="hero mobile">





    <div class="mobile-menu-list">
        <div class="top">
              <a href="{{route(app()->getLocale() . '_' .'homepage')}}" >
                <img src="{{url('logo1.svg')}}" />
              </a>
              <img class="close-menu" src="{{asset('assets/img/close.svg')}}" />
        </div>
        <ul>


          <li><a href="#">Nekilnajams turtas</a></li>
              <li><a href="#">Norintiems parduoti</a></li>
              <li><a href="#">Paslaugos</a></li>
              <li><a href="#">Partneriai</a></li>
              <li><a href="#">Kontaktai</a></li>
              <li class="langs">
                <a @if(Lang::locale()== 'lt') class="active"@endif  href="{{ route('lang', 'lt') }}">LT</a>
                <a @if(Lang::locale()== 'ru') class="active"@endif  href="{{ route('lang', 'ru') }}">RU</a>
              </li>
        </ul>
    </div>





    <div class="background"></div>
    <div class="hero-content-mobile">
      <div class="top">
        <a href="#" class="mobile-menu">
          <img src="{{ asset('assets/img/icon.svg')}} " />
        </a>
          <a href="{{route(app()->getLocale() . '_' .'homepage')}}" >
              <img src="{{url('logo1.svg')}}" />
            </a>

      </div>
      <div class="middle">
            <ul class="sub_menu" >
              @foreach($submenu as $k => $v)
                <li class="@if($itemtype == $k) active @endif" onclick="location='{{route(app()->getLocale() . '_itemtype', $k)}}'; return false;"><a href="#">{{__('submenu.' . $v)}}</a></li>
              @endforeach
                <li class="@if($sellaction ==2) active @endif"><a href="#"  onclick="location='{{route(app()->getLocale() . '_sellaction', 2)}}'; return false;">{{__('submenu.Nuoma')}}</a></li>
              </ul>
      </div>

      <div class="bottom">
        <h2>Raskite savo naujus namus su Alginos NT</h2>
        <form action="{{route('search')}}" method="post" class="search-row" id="search_id">
          @csrf
          <input name="search" type="text" placeholder="{{ __('string.search_placeholder') }}" />
          <img class="search_img" src="{{asset('assets/img/search-sm.svg')}}" onclick="submit(); return false;">
        </form>
        <button class="button">{{ __('string.detailed') }}<div><img id="white" src="{{asset('assets/img/chevron-down.svg')}}"><img id="black" src="{{asset('assets/img/chevron-down2.svg')}}"></div></button>
      </div>
    </div>
  </header>

  <div class="search_block">
    <form action="{{route('search')}}" method="post" id="filter">
      @csrf
      <div class="content">
        <div class="column">
            <select name="floor_from">
              <option value="">{{ __('search.Aukštas nuo') }}</option>
              @foreach(range(1,40) as $v)
                <option value="{{$v}}">{{$v}}</option>
              @endforeach
            </select>
            <div class="from_to">
              {{ __('search.Plotas') }}
              <input type="text" placeholder="nuo" name="area_from">
              <input type="text" placeholder="iki" name="area_to">
              {{ __('search.m') }}
            </div>
            <select name="itemType">
                <option value="">{{ __('search.Tipas') }}</option>
                @foreach($submenu as $key => $menu)
                  <option value="{{$key}}">{{__('submenu.'.$menu)}}</option>
                  @endforeach
                  <option value="nuoma">{{ __('submenu.Nuoma') }}</option>
            </select>
        </div>
        <div class="column">
            <select name="floor_to">
              <option value="">{{ __('search.Aukštas iki') }}</option>
              @foreach(range(1,40) as $v)
                <option value="{{$v}}">{{$v}}</option>
              @endforeach
            </select>
            <div class="from_to">
                {{ __('search.Kaina') }}
              <input type="text" placeholder="nuo" name="price_from">
              <input type="text" placeholder="iki" name="price_to">
              &euro;
            </div>
            @include('MyComponents.select_heating')
        </div>
        <div class="column">
            <select name="roomAmount_from">
              <option value="">{{ __('search.Kambariai nuo') }}</option>
              @foreach(range(1,10) as $v)
                <option value="{{$v}}">{{$v}}</option>
              @endforeach
            </select>
            <select name="years_from">
              <option value="">{{ __('search.Metai nuo') }}</option>
              @foreach(range($min_years, date('Y')) as $v)
                <option value="{{$v}}">{{$v}}</option>
              @endforeach
            </select>
            @include('MyComponents.select_additional_equipment')
        </div>
        <div class="column">
            <select name="roomAmount_to">
              <option value="">{{ __('search.Kambariai iki') }}</option>
              @foreach(range(1,10) as $v)
                <option value="{{$v}}">{{$v}}</option>
              @endforeach
            </select>
            <select name="years_to">
              <option value="">{{ __('search.Metai iki') }}</option>
              @foreach(range($min_years, date('Y')) as $v)
                <option value="{{$v}}">{{$v}}</option>
              @endforeach
            </select>
            <label class="with_photos">
              <input type="checkbox" name="with_photos" value="" /> {{ __('search.Su nuotraukomis') }}
            </label>
        </div>
      </div>
      <div class="button_search">
        <input type="submit" name="submit_search" value="{{ __('search.Ieškoti') }}" />
      </div>
      </form>
  </div>
  @yield('main')

  <div class="hero_bottom">
    <div class="background"></div>
    <div class="hero-content">
        <h2>{{ __('string.bottom_hero_text') }}</h2>
        <div class="search-row">
          <button class="button" onclick="openPopup()">{{ __('string.send_request') }}</button>
        </div>
    </dv>
  </div>
  </div>
  <footer class="footer desktop">
    <div class="top">
      <div class="column">
        <img src="{{url('logo1.svg')}}" />
      </div>
      <div class="column">
        <h4>Butai</h4>
        <ul>
          <li><a href="{{route('search', ['roomAmount_from' => 1, 'roomAmount_to' => 1])}}" >1 kambarių</a></li>
          <li><a href="{{route('search', ['roomAmount_from' => 2, 'roomAmount_to' => 2])}}" >2 kambarių</a></li>
          <li><a href="{{route('search', ['roomAmount_from' => 3, 'roomAmount_to' => 3])}}" >3 kambarių</a></li>
          <li><a href="{{route('search', ['roomAmount_from' => 4])}}" >4 kambarių ir daugiau</a></li>
          <li><a href="#" >Naujos statybos</a></li>
          <li><a href="#" >Bendrabučiai</a></li>
        </ul>
      </div>
      <div class="column">
        <h4>NAMAI</h4>
        <ul>
          <li><a href="{{route('search', ['itemType' => 'namas'])}}" >Gyvenamieji namai</a></li>
          <li><a href="{{route('search', ['itemType' => 'sodas'])}}" >Namai soduose</a></li>
          <li><a href="{{route('search', ['itemType' => 'sodyba'])}}" >Sodybos</a></li>
          <li><a href="{{route('search', ['itemType' => 'patalpa'])}}" >Komercinės patalpos</a></li>
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
      <a href="#">{{ __('string.Privatumo politika') }}</a>
      <div class="middle">
        <p>2025 AlginosNT. {{ __('string.Visos teisės saugomos') }}. {{ __('string.Sprendimas') }}:</p>
        <img src="{{url('satvos.png')}}" />
      </div>
      <div class="socials">
        <p>{{ __('string.Sekite mus') }}</p>
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
  <footer class="footer mobile">
    <div class="top">
      <div class="column">
        <img src="{{url('logo1.svg')}}" />
      </div>
      <div class="column sert-mobile">
        <img src="{{url('image 4.png')}}" />
        <img src="{{url('image 5.png')}}" />
      </div>
    </div>
    <div class="top">
      <div class="column">
        <h4>Butai</h4>
        <ul>
          <li><a href="{{route('search', ['roomAmount_from' => 1, 'roomAmount_to' => 1])}}" >1 kambarių</a></li>
          <li><a href="{{route('search', ['roomAmount_from' => 2, 'roomAmount_to' => 2])}}" >2 kambarių</a></li>
          <li><a href="{{route('search', ['roomAmount_from' => 3, 'roomAmount_to' => 3])}}" >3 kambarių</a></li>
          <li><a href="{{route('search', ['roomAmount_from' => 4])}}" >4 kambarių ir daugiau</a></li>
          <li><a href="#" >Naujos statybos</a></li>
          <li><a href="#" >Bendrabučiai</a></li>
        </ul>
      </div>
      <div class="column">
        <h4>NAMAI</h4>
        <ul>
          <li><a href="{{route('search', ['itemType' => 'namas'])}}" >Gyvenamieji namai</a></li>
          <li><a href="{{route('search', ['itemType' => 'sodas'])}}" >Namai soduose</a></li>
          <li><a href="{{route('search', ['itemType' => 'sodyba'])}}" >Sodybos</a></li>
          <li><a href="{{route('search', ['itemType' => 'patalpa'])}}" >Komercinės patalpos</a></li>
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

    </div>
    <div class="bottom">

        <div class="middle">
          <p>2025 AlginosNT. {{ __('string.Visos teisės saugomos') }}. {{ __('string.Sprendimas') }}:</p>
          <img src="{{url('satvos.png')}}" />
        </div>
      <div class="socials">
        <p>{{ __('string.Sekite mus') }}</p>
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
      <a href="#">{{ __('string.Privatumo politika') }}</a>
    </div>
  </footer>

    @stack('styles')
    @stack('scripts')

    <script>


    document.querySelector('#popupOverlay form').addEventListener('submit', function(e){
        e.preventDefault()


        const form = this
        form.querySelector('.send').textContent = "{{__('string.sending')}}"
         const formData = new FormData(form);

       fetch( "{{route('sendmail')}}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        },
        body: formData
      }).then(item => (item.json()))
      .then(item=> { console.log(item);
          document.querySelector('.response_message').textContent = item.message
          form.reset()
          form.querySelector('.send').textContent = "{{__('string.Siųsti')}}"
        setTimeout(() => {
          document.querySelector('.response_message').textContent = ''
          document.querySelector('#popupOverlay').click()

        }, 2000);
      })
    })


    function openPopup() {
        document.getElementById('popupOverlay').style.display = 'flex';
        document.body.style.overflow = 'hidden'
        if(document.querySelector('#item_id')){
          var input = document.createElement("input");
          input.type = "hidden";
          input.name = "item_id";
          input.value = document.querySelector('#item_id').value
            document.querySelector('#popupOverlay form').prepend(input)
        }
        if(document.querySelector('#recepient')){
          var input2 = document.createElement("input");
          input2.type = "hidden";
          input2.name = "recepient";
          input2.value = document.querySelector('#recepient').value
            document.querySelector('#popupOverlay form').prepend(input2)
        }
      }

      function closePopup(e) {

        if( e.target.classList.contains('close-btn') || e.target.classList.contains('overlay') ){
          document.getElementById('popupOverlay').style.display = 'none';
          document.body.style.overflow = 'visible'
        }
      }

      document.querySelector('.mobile-menu').addEventListener('click', function(){
        var element = document.querySelector('.mobile-menu-list')
        element.classList.remove('close')
        element.classList.add('open')
        document.body.style.setProperty('overflow', 'hidden')

      })
      document.querySelector('.close-menu').addEventListener('click', function(){
        var element = document.querySelector('.mobile-menu-list')
          element.classList.add('close')
          element.classList.remove('open')
          document.body.style.setProperty('overflow', 'visible')
      })
      document.querySelector('.mobile-menu-list').addEventListener('click', function(e){

        if(e.target.classList.contains('mobile-menu-list')){
          var element = document.querySelector('.mobile-menu-list')
            element.classList.add('close')
            element.classList.remove('open')
            document.body.style.setProperty('overflow', 'visible')
          }
      })

      document.querySelector('#filter').addEventListener('submit', function(e){
        e.preventDefault()

        var aa = [
          ...this.querySelectorAll('select'),
          ...this.querySelectorAll('input[type="text"], #additional_equipment, #heating_input'),
          ...this.querySelector('input[name="with_photos"]').checked ? [1] : []
      ];
         if( aa.some(item => item.value !='') ) this.submit()

      })

      document.querySelector('#search_id')
        .addEventListener("keypress", function(e) {
          if (event.keyCode === 13) {
            e.preventDefault();
            document.querySelector('#search_id').submit();
            return false
        }

    });

        [...document.querySelectorAll('.hero-content .bottom .button, .hero-content-mobile .bottom .button')]
        .forEach(item => {
            item.addEventListener('click', function(e){
                e.preventDefault()
                if(this.classList.contains('active')){
                  //  window.scrollTo({
                  //    top: 0,
                  //    left: 0,
                  //    behavior: "smooth",
                  //  });
                    // setTimeout(() => {
                      this.classList.remove('active')
                      document.querySelector('.search_block').classList.remove('visible')
                    // }, 200);
                  }else{

                  this.classList.add('active')
                  document.querySelector('.search_block').classList.add('visible')
                  //  window.scrollTo({
                  //     top: 300,
                  //     left: 0,
                  //     behavior: "smooth",
                  //   });
                }

            })
        })

    </script>
    @include('cookie-consent::index')
</body>
</html>
