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
          <textarea name="message" rows="2" placeholder="{{ __('string.Žinutė') }}" ></textarea>
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
        <form action="{{route('search')}}" method="post" class="search-row search_id">
          @csrf
          <input name="search" type="text" placeholder="{{ __('string.search_placeholder') }}" />
          <img class="search_img" src="{{asset('assets/img/search-sm.svg')}}" onclick="submit(); return false;">
          <button class="button search_open_button">{{ __('string.detailed') }}<div><img id="white" src="{{asset('assets/img/chevron-down.svg')}}"><img id="black" src="{{asset('assets/img/chevron-down2.svg')}}"></div></button>
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
             @foreach($main_menu as $k => $v)
                <li @if($active_main_menu_link == $k) class="active" @endif><a href="{{route(app()->getLocale() . '_' . $k)}}">{{__('main_menu.'. $v)}}</a></li>
            @endforeach
              <li class="langs">
                <a @if(Lang::locale()== 'lt') class="active"@endif  href="{{ route('lang',  ['locale'=>'lt']) }}">LT</a>
                <a @if(Lang::locale()== 'ru') class="active"@endif  href="{{ route('lang',  ['locale'=>'ru']) }}">RU</a>
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
        <h2>{{__('string.hero_text') }}</h2>
        <form action="{{route('search')}}" method="post" class="search-row search_id">
          @csrf
          <input name="search" type="text" placeholder="{{ __('string.search_placeholder') }}" />
          <img class="search_img" src="{{asset('assets/img/search-sm.svg')}}" onclick="submit(); return false;">
        </form>
        <button class="button search_open_button">{{ __('string.detailed') }}<div><img id="white" src="{{asset('assets/img/chevron-down.svg')}}"><img id="black" src="{{asset('assets/img/chevron-down2.svg')}}"></div></button>
      </div>
    </div>
  </header>

  <div class="search_block">
    <form action="{{route('search')}}" method="post" id="filter">
      @csrf

<br>
    <p>{{ __('string.choose_cat') }}</p>
<br>
 {{-- search block    =========================================--}}












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
        <a href="{{route(app()->getLocale() . '_' .'homepage')}}">
          <img src="{{url('logo1.svg')}}" />
        </a>
      </div>
      <div class="column">
        <h4>{{__('footer.Butai')}}</h4>
        <ul>
          <li><a href="{{route('search', ['roomAmount_from' => 1, 'roomAmount_to' => 1, 'itemType' => 'butas'])}}" >{{__('footer.1 kambarių')}}</a></li>
          <li><a href="{{route('search', ['roomAmount_from' => 2, 'roomAmount_to' => 2, 'itemType' => 'butas'])}}" >{{__('footer.2 kambarių')}}</a></li>
          <li><a href="{{route('search', ['roomAmount_from' => 3, 'roomAmount_to' => 3, 'itemType' => 'butas'])}}" >{{__('footer.3 kambarių')}}</a></li>
          <li><a href="{{route('search', ['roomAmount_from' => 4, 'itemType' => 'butas'])}}" >{{__('footer.4 kambarių ir daugiau')}}</a></li>
          <li><a href="{{route('search', ['years_from' => $d->format('Y'), 'years_to' => date('Y'), 'itemType' => 'butas'])}}" >{{__('footer.Naujos statybos')}}</a></li>
        </ul>
      </div>
      <div class="column">
        <h4>{{__('footer.NAMAI')}}</h4>
        <ul>
          <li><a href="{{route(app()->getLocale() . '_itemtype', __('submenu.namas'))}}" >{{__('footer.Gyvenamieji namai')}}</a></li>
          <li><a href="{{route('search', ['itemType' => 'sodas'])}}" >{{__('footer.Namai soduose')}}</a></li>
          <li><a href="{{route('search', ['itemType' => 'sodyba'])}}" >{{__('footer.Sodybos')}}</a></li>
          <li><a href="{{route('search', ['itemType' => 'patalpa'])}}" >{{__('footer.Komercinės patalpos')}}</a></li>
        </ul>
      </div>
      <div class="column">
        <h4>{{__('footer.Patalpos')}}</h4>
        <ul>
          <li><a href="{{route('search', ['purpose2' => 'Administracinė', 'itemType' => 'patalpa'])}}" >{{__('footer.Administracinės patalpos')}}</a></li>
          <li><a href="{{route('search', ['purpose2' => 'Sandeliavimo', 'itemType' => 'patalpa'])}}" >{{__('footer.Sandeliavimo patalpos')}}</a></li>
          <li><a href="{{route('search', ['purpose2' => 'Prekybos', 'itemType' => 'patalpa'])}}" >{{__('footer.Prekybos patalpos')}}</a></li>
          <li><a href="{{route('search', ['purpose2' => 'Viešbučių', 'itemType' => 'patalpa'])}}" >{{__('footer.Viešbučių patalpos')}}</a></li>
        </ul>
      </div>
      <div class="column sert">
        <img src="{{url('image5.gif')}}" />
        <img src="{{url('image6.gif')}}" />
        <img src="{{url('image77.gif')}}" />
      </div>
    </div>
    <div class="bottom">
      <a href="{{ route(app()->getlocale() . '_privacy') }}">{{ __('string.Privatumo politika') }}</a>
      <div class="middle">
        <p>2025 AlginosNT. {{ __('string.Visos teisės saugomos') }}. {{ __('string.Sprendimas') }}:</p>
        <img src="{{url('satvos.png')}}" />
      </div>
      <div class="socials">
        <p>{{ __('string.Sekite mus') }}</p>
        <a href="https://www.facebook.com/share/1PRbBMGrq2/?mibextid=wwXIfr" target="_blank">
          <img src="{{url('Vector (3).png')}}" />
        </a>
        <a href="https://www.instagram.com/alginosnt?igsh=MWd6aGdoOXR6b3lvbA%3D%3D&utm_source=qr" target="_blank">
          <img src="{{url('Social Icons.png')}}" />
        </a>
        <a href="https://www.tiktok.com/@alginos.nt?_t=ZN-8yrtS1UVHR0&_r=1" target="_blank">
          <img src="{{url('Vector (4).png')}}" />
        </a>
      </div>
    </div>
  </footer>
  <footer class="footer mobile">
    <div class="top">
      <div class="column">
        <a href="{{route(app()->getLocale() . '_' .'homepage')}}" >
          <img src="{{url('logo1.svg')}}" />
        </a>
      </div>
      <div class="column sert-mobile">
        <img src="{{url('image5.gif')}}" />
        <img src="{{url('image6.gif')}}" />
        <img src="{{url('image77.gif')}}" />
      </div>
    </div>
    <div class="top">
      <div class="column">
        <h4>{{__('footer.Butai')}}</h4>
        <ul>
          <li><a href="{{route('search', ['roomAmount_from' => 1, 'roomAmount_to' => 1, 'itemType' => 'butas'])}}" >{{__('footer.1 kambarių')}}</a></li>
          <li><a href="{{route('search', ['roomAmount_from' => 2, 'roomAmount_to' => 2, 'itemType' => 'butas'])}}" >{{__('footer.2 kambarių')}}</a></li>
          <li><a href="{{route('search', ['roomAmount_from' => 3, 'roomAmount_to' => 3, 'itemType' => 'butas'])}}" >{{__('footer.3 kambarių')}}</a></li>
          <li><a href="{{route('search', ['roomAmount_from' => 4, 'itemType' => 'butas'])}}" >{{__('footer.4 kambarių ir daugiau')}}</a></li>
          <li><a href="{{route('search', ['years_from' => $d->format('Y'), 'years_to' => date('Y'), 'itemType' => 'butas'])}}" >{{__('footer.Naujos statybos')}}</a></li>
        </ul>
      </div>
      <div class="column">
        <h4>{{__('footer.NAMAI')}}</h4>
        <ul>
          <li><a href="{{route(app()->getLocale() . '_itemtype', __('submenu.namas'))}}" >{{__('footer.Gyvenamieji namai')}}</a></li>
          <li><a href="{{route('search', ['itemType' => 'sodas'])}}" >{{__('footer.Namai soduose')}}</a></li>
          <li><a href="{{route('search', ['itemType' => 'sodyba'])}}" >{{__('footer.Sodybos')}}</a></li>
          <li><a href="{{route('search', ['itemType' => 'patalpa'])}}" >{{__('footer.Komercinės patalpos')}}</a></li>
        </ul>
      </div>
      <div class="column">
        <h4>{{__('footer.Patalpos')}}</h4>
        <ul>
          <li><a href="{{route('search', ['purpose2' => 'Administracinė', 'itemType' => 'patalpa'])}}" >{{__('footer.Administracinės patalpos')}}</a></li>
          <li><a href="{{route('search', ['purpose2' => 'Sandeliavimo', 'itemType' => 'patalpa'])}}" >{{__('footer.Sandeliavimo patalpos')}}</a></li>
          <li><a href="{{route('search', ['purpose2' => 'Prekybos', 'itemType' => 'patalpa'])}}" >{{__('footer.Prekybos patalpos')}}</a></li>
          <li><a href="{{route('search', ['purpose2' => 'Viešbučių', 'itemType' => 'patalpa'])}}" >{{__('footer.Viešbučių patalpos')}}</a></li>
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
      <a href="{{ route(app()->getlocale() . '_privacy') }}">{{ __('string.Privatumo politika') }}</a>
    </div>
  </footer>

    @stack('styles')
    @stack('scripts')

    <script>

       document.querySelector('select[name="region"]')?.addEventListener('change', function(){

        document.querySelector('select[name="city"]').disabled = true
        document.querySelector('select[name="city"]').innerHTML = '<option value="">Gyvenviete</option>'
        document.querySelector('#quarter').classList.add('disabled')
        document.querySelector("#quarter").querySelector(".options-container5").innerHTML = ''
        document.querySelector("#quarter2").value = ""
        document.querySelector('#street').classList.add('disabled')
        document.querySelector("#street").querySelector(".options-container6").innerHTML = ''
        document.querySelector("#street2").value = ""
        // document.querySelector('#quarter .options-container-common').innerHTML = ''
        document.querySelector("#quarter").querySelector(".select-box5").textContent = "{{ __('string.Mikrorajonas') }}";
        document.querySelector("#street").querySelector(".select-box6").textContent = "{{ __('string.Gatvė') }}";


           const id = this.value
           fetch( `/getRegion?region=${id}`)
        .then(item => item.text())
        .then(html => {
            if(html){
                document.querySelector('select[name="city"]').disabled = false
                document.querySelector('select[name="city"]').innerHTML = html
            }else{
                document.querySelector('select[name="city"]').disabled = true
                document.querySelector('select[name="city"]').innerHTML = '<option value="">Gyvenviete</option>'
            }
        })
    })


       document.querySelector('select[name="city"]')?.addEventListener('change', function(){
           const id = this.value
           fetch( `/getMikroregion?miestas=${id}`)
           .then(item => item.text())
           .then(html => {

           if(html){
                document.querySelector('#quarter').classList.remove('disabled')
                document.querySelector('.options-container5').innerHTML = html

                update_select5()

            }else{
                document.querySelector('#quarter').classList.add('disabled')
                document.querySelector("#quarter").querySelector(".select-box5").textContent = "{{ __('string.Mikrorajonas') }}";
            }
        })
              fetch( `/getGatve?miestas=${id}`)
                .then(item2 => item2.text())
                .then(data => {
                    if(data){
                        document.querySelector('#street').classList.remove('disabled')
                document.querySelector('.options-container6').innerHTML = data

                update_select6()

                        } else {
                            document.querySelector('#street').classList.add('disabled')
                document.querySelector("#street").querySelector(".select-box6").textContent = "{{ __('string.Gatvė') }}";
                        }
                })
    })

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
          ...this.querySelectorAll('input[type="text"], #additional_equipment, #heating_input, #purpose, #purpose2'),
          ...this.querySelector('input[name="with_photos"]').checked ? [1] : []
      ];
         if( aa.some(item => item.value !='') ) this.submit()

      })

          document.querySelectorAll('.search_id')
        .forEach(item => { item
        .addEventListener("keypress", function(e) {
          if (event.keyCode === 13) {
            e.preventDefault();
            item.submit();
            return false
        }
    })
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

                    [...document.querySelectorAll('.search_open_button')]
                      .forEach(item => item.classList.remove('active'))
                      document.querySelector('.search_block').classList.remove('open_search')
                    // }, 200);
                  }else{

                  [...document.querySelectorAll('.search_open_button')]
                      .forEach(item => item.classList.add('active'))
                  document.querySelector('.search_block').classList.add('open_search')
                  //  window.scrollTo({
                  //     top: 300,
                  //     left: 0,
                  //     behavior: "smooth",
                  //   });
                }

            })
        })

    </script>
    <x-gdpr-consent />

</body>
</html>
