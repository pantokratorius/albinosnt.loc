@extends('layouts.frontend')

@if(app()->getLocale() == 'lt')
  @section('title', 'AlginosNT – Mūsų paslaugos: paskolos, skelbimų reklama, konsultacijos')
  @section('description', 'AlginosNT teikia nekilnojamojo turto paslaugas: banko paskolos, NT reklama, derybų vedimas, konsultacijos investicijoms, dokumentų rengimas. Klaipėda.')
  @section('schema')
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Service",
      "serviceType": "Nekilnojamojo turto paslaugos",
      "provider": {
        "@type": "RealEstateAgent",
        "name": "AlginosNT",
        "url": "https://alginosnt.lt/paslaugos",
        "logo": "https://alginosnt.lt/images/logo.png",
        "telephone": "+37060450021",
        "email": "info@alginosnt.lt",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "Taikos pr. 52c–604",
          "addressLocality": "Klaipėda",
          "postalCode": "",
          "addressCountry": "LT"
        }
      },
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "AlginosNT paslaugos",
        "itemListElement": [
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Banko paskolos",
              "description": "Konsultacijos, paraiškos ir dokumentų tvarkymas paskolų gavimui visuose bankuose."
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "NT skelbimų reklama",
              "description": "Skelbimų paruošimas: nuotraukos, planai, aprašymai ir skelbimas portaluose."
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Derybų vedimas",
              "description": "Interesų atstovavimas derybose, dokumentų ruošimas, notarų patvirtinimas."
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Konsultacijos ir investicijos",
              "description": "Strateginės konsultacijos dėl NT investicijų ir projektų įgyvendinimo."
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Dokumentų paruošimas",
              "description": "Visų būtinų dokumentų surinkimas, patikrinimas ir parengimas sandoriams."
            }
          }
        ]
      }
    }
    </script>
  @stop


  @else

       @section('title', 'Alginos NT – Услуги по недвижимости в Литве')
  @section('description', 'Продажа и аренда недвижимости в Литве: квартиры, дома, участки, коммерческие объекты и садовые участки. Найдите идеальный вариант с Alginos NT.')
  @section('schema')
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "RealEstateAgent",
    "name": "Alginos NT",
    "url": "https://alginosnt.lt/ru/услуги",
    "description": "Продажа и аренда недвижимости в Литве: квартиры, дома, участки, коммерческие объекты и садовые участки.",
    "logo": "https://alginosnt.lt/images/logo.png",
    "sameAs": ["https://www.facebook.com/alginosNT?mibextid=wwXIfr&rdid=gtALcBBNZQa5R6rV#",
      "https://www.instagram.com/alginosnt?igsh=MWd6aGdoOXR6b3lvbA%3D%3D&utm_source=qr",
      "https://www.tiktok.com/@alginos.nt?_t=ZN-8yrtS1UVHR0&_r=1"]
  }
  </script>
  @stop

  @endif




@section('main')


  <main class="services_wrap">
       @if(app()->getLocale() == 'lt')  <h2>{{$data[0]->title}}</h2>
       @else <h2>{{$data[0]->title_ru}}</h2>
       @endif

       @if(app()->getLocale() == 'lt')  {!!$data[0]->description!!}
       @else {!!$data[0]->description_ru!!}
       @endif

    <div class="services_block">

      @foreach ($data as $k => $v)

        <div class="block">
          <img src="{{asset('storage/services/'.$v->block_image) }}" alt="">
           @if(app()->getLocale() == 'lt')  <h3>{{$v->block_title}}</h3>
            @else <h3>{{$v->block_title_ru}}</h3>
            @endif

             @if(app()->getLocale() == 'lt')  {!!$v->block_text!!}
            @else {!!$v->block_text_ru!!}
            @endif
        </div>
        @endforeach

    </dv>

  </main>



@stop

@push('scripts')
<script>


    </script>
  @endpush
