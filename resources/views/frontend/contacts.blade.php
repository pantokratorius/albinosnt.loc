@extends('layouts.frontend')
  @if(app()->getLocale() == 'lt')
    @section('title', 'AlginosNT – Kontaktai')
    @section('description', 'AlginosNT kontaktai: adresas, telefonas, el. paštas ir įmonės rekvizitai. Kreipkitės dėl nekilnojamojo turto pardavimo, nuomos ar konsultacijų.')
    @section('schema')
    <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "RealEstateAgent",
        "name": "AlginosNT",
        "url": "https://alginosnt.lt/kontaktai",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "Taikos pr. 52c – 604",
          "addressLocality": "Klaipėda",
          "addressCountry": "LT"
        },
        "telephone": "+37060450021",
        "email": "info@alginosnt.lt",
        "vatID": "LT100014557514",
        "taxID": "304081305",
        "sameAs": [
          "https://www.facebook.com/alginosNT?mibextid=wwXIfr&rdid=gtALcBBNZQa5R6rV#",
          "https://www.instagram.com/alginosnt?igsh=MWd6aGdoOXR6b3lvbA%3D%3D&utm_source=qr",
          "https://www.tiktok.com/@alginos.nt?_t=ZN-8yrtS1UVHR0&_r=1"
        ]
      }
      </script>
@stop
@else
      @section('title', 'Alginos NT - Контакты')
    @section('description', 'Свяжитесь с Alginos NT для получения консультации по недвижимости в Литве. Адрес: Taikos pr. 52c – 604, Klaipėda. Телефон: +370 604 50021.')
    @section('schema')
    <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "RealEstateAgent",
    "name": "Alginos NT",
    "url": "https://alginosnt.lt/ru/контакты",
    "description": "Профессиональные услуги в сфере недвижимости в Литве.",
    "logo": "https://alginosnt.lt/images/logo.png",
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "+370 604 50021",
      "contactType": "customer service",
      "areaServed": "LT",
      "availableLanguage": "ru"
    },
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Taikos pr. 52c – 604",
      "addressLocality": "Klaipėda",
      "postalCode": "LT-92294",
      "addressCountry": "LT"
    }
  }
  </script>
    @stop

@endif


@section('main')


  <main class="contact_wrap">

        <div class="contact_info">
             @if(app()->getLocale() == 'lt')  <h2>{{$data->title}}</h2>
            @else <h2>{{$data->title_ru}}</h2>
            @endif
             <ul>
                <li><b>{{ __('string.Įmonės kodas') }}: </b>{{$data->ik}}</li>
                <li><b>{{ __('string.PVM mokėtojo kodas') }}: </b>{{$data->mk}}</li>
                <li><b>{{ __('string.Telefonas') }}: </b>{{$data->phone}}</li>
                <li><b>{{ __('string.El. paštas') }}: </b>{{$data->email}}</li>
                <li><b>{{ __('string.Adresas') }}: </b>{{$data->address}}</li>
             </ul>

             <form action="" method="post" id="contacts_form">
                 @csrf
                 <p class="name">
                     <input type="text" name="name" id="" placeholder="{{ __('string.Vardas') }}">
                     <input type="text" name="surname" id="" placeholder="{{ __('string.Pavardė') }}">
                    </p>
                    <p>
                        <input type="email" name="email" id="" placeholder="{{ __('string.E-paštas') }}">
                    </p>
                    <p>
                        <input type="text" name="phone" id="" required placeholder="{{ __('string.Telefonas') }}*">
                    </p>
                    <p>
                        <textarea name="message" id="" placeholder="{{ __('string.Žinutė') }}"></textarea>
                    </p>
                    <p>
                        <input type="submit" value="{{ __('string.Siųsti') }}">
                    </p>
                    <input type="hidden" name="page" value="Kontaktai" />
                </form>
            </div>



        <div class="map">{!!$data->map!!}</div>

  </main>



@stop

@push('scripts')
<script>
      document.querySelector('#contacts_form').addEventListener('submit', function(e){
        e.preventDefault()
        document.querySelector('#contacts_form input[type="submit"]').value = "{{ __('string.sending') }}"
        const form = this
         const formData = new FormData(form);

       fetch( "{{route('sendmail')}}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        },
        body: formData
      }).then(item => (item.json()))
      .then(item=> {
            document.querySelector('#contacts_form input[type="submit"]').value = item.message
            form.reset()
        setTimeout(() => {
            document.querySelector('#contacts_form input[type="submit"]').value = "{{ __('string.Siųsti') }}"
        }, 2000);
      })
    })

    </script>
  @endpush
