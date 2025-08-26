@extends('layouts.frontend')

@if(app()->getLocale() == 'lt')
  @section('title', 'AlginosNT – Nekilnojamojo turto pardavimas ir nuoma Lietuvoje')
  @section('description', 'AlginosNT – butai, namai, sodybos ir komercinės patalpos visoje Lietuvoje. Raskite geriausius NT pasiūlymus greitai ir patogiai.')
  @section('schema')
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "RealEstateAgent",
      "name": "AlginosNT",
      "url": "https://www.alginosnt.lt",
      "logo": "{{url('logo.svg')}}",
      "description": "@yield('description')",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Taikos pr. 52c – 604",
        "addressLocality": "Klaipėda",
        "postalCode": "LT-91184",
        "addressCountry": "LT"
      },
      "sameAs": [
        "https://www.facebook.com/alginosNT?mibextid=wwXIfr&rdid=gtALcBBNZQa5R6rV#",
        "https://www.instagram.com/alginosnt?igsh=MWd6aGdoOXR6b3lvbA%3D%3D&utm_source=qr",
        "https://www.tiktok.com/@alginos.nt?_t=ZN-8yrtS1UVHR0&_r=1"
      ]
    }
    </script>
  @stop

@else

    @section('title', 'AlginosNT – Найдите новое жилье в Литве | Недвижимость на русском')
  @section('description', 'AlginosNT – недвижимость в Литве на русском языке. Квартиры, дома, участки, коммерческие объекты. Удобный поиск и поддержка на русском.')
  @section('schema')
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "AlginosNT (русская версия)",
    "url": "https://alginosnt.lt/ru",
    "description": "AlginosNT предоставляет услуги по продаже и аренде недвижимости в Литве — на русском языке.",
    "inLanguage": "ru",
    "potentialAction": {
      "@type": "SearchAction",
      "target": "https://alginosnt.lt/ru/",
    }
  }
  </script>
  @stop


@endif

@section('main')


  <main>
      <div class="title">
          <h3>{{ __('main_menu.nekilnojamas turtas') }}@if(!empty($itemtype)) | {{__('submenu.'.$submenu[$itemtype])}}@endif</h3>
          <div class="view">
            {{ __('string.Peržiūra') }}
            <img
                @if(session('type') != 'tile')
                  class="active"
                  src="{{asset('assets/img/grid-svgrepo-com_active.svg')}}"
                  @else
                  src="{{asset('assets/img/grid-svgrepo-com.svg')}}"
                  onclick="location='{{ request()->fullUrlWithQuery(['type' => 'simple']) }}'; return false;"
                @endif
                />
            <img
            @if(session('type') == 'tile')
                  class="active"
                  src="{{asset('assets/img/Vector_sand_active.svg')}}"
                  @else
                  src="{{asset('assets/img/vector _sand.svg')}}"
                  onclick="location='{{ request()->fullUrlWithQuery(['type' => 'tile']) }}'; return false;"
                @endif
            />
          </div>
      </div>

      <div class="items">

        @forelse($data as $v)
      @if(session('type') != 'tile')
          <div class="item desktop2" >
            <div class="image" onclick="location='{{route(app()->getlocale() . '_nt_item', $v->id)}}'; return false">
              @if(isset($photo[$v->id]))
                <img src="{{asset('storage/skelbimai/' . $photo[$v->id]) }}" />
                @else
                <img src="{{url('timthumb.png') }}" />
              @endif
            </div>
            <div class="data">
              <span>ID: {{$v->id}}</span>
           @if($v->roomAmount > 0)<span>{{$v->roomAmount}} {{ __('string.kamb') }}.</span>  @endif
                   @if($v->size > 0)<span>{{$v->size}} {{ __('string.kv.m') }}</span>  @endif
                     @if($v->floor > 0 ||  ($v->floorNr > 0) && $itemtype == 'butas')
                      <span>{{$v->floor > 0 ? $v->floor : ''}}{{$v->floorNr > 0 ? '/'.$v->floorNr : ''}} {{ __('string.a') }}. </span>
                     @elseif($v->landSize > 0
                        && ($itemtype == 'namas' || $itemtype == 'sodyba' || $itemtype == 'sodas' || $itemtype == 'patalpa' || $itemtype == 'sklypas')
                    )
                      <span>{{$v->landSize }} {{ __('string.a') }}. </span>
                     @endif
                     @if($v->purpose != '')
                        <span>{{str_replace(';', ', ', $v->purpose)}} </span>
                     @endif
                    @if($v->years > 0)<span>{{$v->years}} {{ __('string.m') }}.</span>@endif
            </div>
            <div class="description">
              <h4 onclick="location='{{route(app()->getlocale() . '_nt_item', $v->id)}}'; return false">
                @if($v->roomAmount > 0 && $itemtype == 'butas')
                {{ $v->roomAmount . ' ' . __('string.kamb') .'. '.__('submenu.' . $itemtype).',' }}
                @elseif($v->floorNr > 0 && $itemtype == 'namas')
                {{ $v->floorNr . ' a. '.__('submenu.' . $itemtype).',' }}
                @elseif($v->landSize > 0
                    && ($itemtype == 'sodyba' || $itemtype == 'sklypas' || $itemtype == 'sodas')
                )
                {{ $v->landSize . ' a. '.$itemtype.',' }}
                @elseif($v->sizeFull > 0 && $itemtype == 'patalpa')
                {{ $v->sizeFull . ' kv. m. '.$itemtype.',' }}
                @endif
                 @if(isset($streets[$v->id])){{$streets[$v->id]}}@endif @if(isset($city[$v->id])){{$city[$v->id]}}@endif
              </h4>
              <div class="text">
                     @if(app()->getLocale() == 'lt')
                      {{$v->notes_lt}}
                      @else
                      {{$v->notes_ru}}
                      @endif
              </div>
            </div>
            <div class="price">
              <span>{{number_format($v->price, 0, ',', ' ')}} €</span>
              <button class="more" onclick="location='{{route(app()->getlocale() . '_nt_item', $v->id)}}'; return false">{{ __('string.Plačiau') }}</button>
            </div>
          </div>
@else
          <div class="item_block desktop2"  >
            <div class="image" onclick="location='{{route(app()->getlocale() . '_nt_item', $v->id)}}'; return false">
              @if(isset($photo[$v->id]))<img src="{{asset('storage/skelbimai/' . $photo[$v->id]) }}" />@endif
            </div>
            <div class="data_wrap">

              <div class="description">
                <div>
                  <h4 onclick="location='{{route(app()->getlocale() . '_nt_item', $v->id)}}'; return false">
                    @if($v->roomAmount > 0 && $itemtype == 'butas')
                        {{ $v->roomAmount . ' kamb. '.$itemtype.',' }}
                        @elseif($v->floorNr > 0 && $itemtype == 'namas')
                        {{ $v->floorNr . ' a. '.$itemtype.',' }}
                        @elseif($v->landSize > 0
                            && ($itemtype == 'sodyba' || $itemtype == 'sklypas' || $itemtype == 'sodas')
                        )
                        {{ $v->landSize . ' a. '.$itemtype.',' }}
                        @elseif($v->sizeFull > 0 && $itemtype == 'patalpa')
                        {{ $v->sizeFull . ' kv. m. '.$itemtype.',' }}
                    @endif
                    @if(isset($streets[$v->id])){{$streets[$v->id]}}@endif @if(isset($city[$v->id])){{$city[$v->id]}}@endif
                  </h4>
                  <div class="data">
              <span>ID: {{$v->id}}</span>
           @if($v->roomAmount > 0)<span>{{$v->roomAmount}} {{ __('string.kamb') }}.</span>  @endif
                   @if($v->size > 0)<span>{{$v->size}} {{ __('string.kv.m') }}</span>  @endif
                     @if($v->floor > 0 ||  ($v->floorNr > 0) && $itemtype == 'butas')
                      <span>{{$v->floor > 0 ? $v->floor : ''}}{{$v->floorNr > 0 ? '/'.$v->floorNr : ''}} {{ __('string.a') }}. </span>
                     @elseif($v->landSize > 0
                        && ($itemtype == 'namas' || $itemtype == 'sodyba' || $itemtype == 'sodas' || $itemtype == 'patalpa' || $itemtype == 'sklypas')
                    )
                      <span>{{$v->landSize }} {{ __('string.a') }}. </span>
                     @endif
                     @if($v->purpose != '')
                        <span>{{str_replace(';', ', ', $v->purpose)}} </span>
                     @endif
                    @if($v->years > 0)<span>{{$v->years}} {{ __('string.m') }}.</span>@endif
            </div>
                  <div class="text">
                         @if(app()->getLocale() == 'lt')
                      {{$v->notes_lt}}
                      @else
                      {{$v->notes_ru}}
                      @endif
                  </div>
                  </div>
                  <div>
                  <div class="price">
                    <span>{{number_format($v->price, 0, ',', ' ')}} €</span>
                  </div>
                  </div>
              </div>
            </div>
          </div>
          @endif
          <div class="item mobile2" >
            <div class="image" onclick="location='{{route(app()->getlocale() . '_nt_item', $v->id)}}'; return false">
              @if(isset($photo[$v->id]))<img src="{{asset('storage/skelbimai/' . $photo[$v->id]) }}" />@endif
            </div>
            <div class="data">
              <span>ID: {{$v->id}}</span>
           @if($v->roomAmount > 0)<span>{{$v->roomAmount}} {{ __('string.kamb') }}.</span>  @endif
                   @if($v->size > 0)<span>{{$v->size}} {{ __('string.kv.m') }}</span>  @endif
                     @if($v->floor > 0 ||  ($v->floorNr > 0) && $itemtype == 'butas')
                      <span>{{$v->floor > 0 ? $v->floor : ''}}{{$v->floorNr > 0 ? '/'.$v->floorNr : ''}} {{ __('string.a') }}. </span>
                     @elseif($v->landSize > 0
                        && ($itemtype == 'namas' || $itemtype == 'sodyba' || $itemtype == 'sodas' || $itemtype == 'patalpa' || $itemtype == 'sklypas')
                    )
                      <span>{{$v->landSize }} {{ __('string.a') }}. </span>
                     @endif
                     @if($v->purpose != '')
                        <span>{{str_replace(';', ', ', $v->purpose)}} </span>
                     @endif
                    @if($v->years > 0)<span>{{$v->years}} {{ __('string.m') }}.</span>@endif
            </div>
            <div class="description">
              <h4 onclick="location='{{route(app()->getlocale() . '_nt_item', $v->id)}}'; return false">
                @if($v->roomAmount > 0 && $itemtype == 'butas')
                {{ $v->roomAmount . ' kamb. '.$itemtype.',' }}
                @elseif($v->floorNr > 0 && $itemtype == 'namas')
                {{ $v->floorNr . ' a. '.$itemtype.',' }}
                @elseif($v->landSize > 0
                    && ($itemtype == 'sodyba' || $itemtype == 'sklypas' || $itemtype == 'sodas')
                )
                {{ $v->landSize . ' a. '.$itemtype.',' }}
                @elseif($v->sizeFull > 0 && $itemtype == 'patalpa')
                {{ $v->sizeFull . ' kv. m. '.$itemtype.',' }}
                @endif
                @if(isset($streets[$v->id])){{$streets[$v->id]}}@endif @if(isset($city[$v->id])){{$city[$v->id]}}@endif
              </h4>
              <div class="text">
                     @if(app()->getLocale() == 'lt')
                      {{$v->notes_lt}}
                      @else
                      {{$v->notes_ru}}
                      @endif
              </div>
            </div>
            <div class="price">
              <span>{{number_format($v->price, 0, ',', ' ')}} €</span>
              <button class="more" onclick="location='{{route(app()->getlocale() . '_nt_item', $v->id)}}'; return false">{{ __('string.Plačiau') }}</button>
            </div>
          </div>
          @empty
            <div class="item_block" >
                <h3 class="no_items">{{__('string.Įrašų nerasta')}}</h3>
            </div>
          @endforelse
      </div>
  </main>

  <div class="pagination">
    {{ $data->onEachSide(0)->links() }}
  </div>

@stop

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function(){
      if(location.search.indexOf('page=') +1)
          window.scrollTo(0, document.querySelector('main').offsetTop);
        })

    </script>
  @endpush
