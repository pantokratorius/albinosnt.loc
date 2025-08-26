@extends('layouts.frontend')


@if(app()->getLocale() == 'lt')
    @section('title', 'AlginosNT – Mūsų partneriai: patikimiausi bankai ir finansiniai sprendimai')
    @section('description', 'AlginosNT bendradarbiauja su SEB, Luminor, Swedbank ir Urbo Banku – patikimi partneriai nekilnojamojo turto finansavime ir sprendimuose.')
    @section('schema')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "AlginosNT",
        "url": "https://alginosnt.lt/partneriai",
        "logo": "https://alginosnt.lt/images/logo.png",
        "sameAs": [
        "https://www.facebook.com/alginosNT?mibextid=wwXIfr&rdid=gtALcBBNZQa5R6rV#",
        "https://www.instagram.com/alginosnt?igsh=MWd6aGdoOXR6b3lvbA%3D%3D&utm_source=qr",
        "https://www.tiktok.com/@alginos.nt?_t=ZN-8yrtS1UVHR0&_r=1"
        ],
        "memberOf": [
        {
            "@type": "Organization",
            "name": "SEB",
            "url": "https://www.seb.lt"
        },
        {
            "@type": "Organization",
            "name": "Luminor",
            "url": "https://www.luminor.lt"
        },
        {
            "@type": "Organization",
            "name": "Swedbank",
            "url": "https://www.swedbank.lt"
        },
        {
            "@type": "Organization",
            "name": "Urbo Bankas",
            "url": "https://www.urbobank.lt"
        }
        ]
    }
    </script>
    @stop

@else 
@section('title', 'Alginos NT – Наши партнёры')
    @section('description', 'Alginos NT сотрудничает с надёжными партнёрами в сфере недвижимости и финансов: SEB, Luminor, Swedbank и Urbo Bankas.')
    @section('schema')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "AlginosNT",
        "url": "https://alginosnt.lt/партнеры",
        "logo": "https://alginosnt.lt/images/logo.png",
        "sameAs": [
        "https://www.facebook.com/alginosNT?mibextid=wwXIfr&rdid=gtALcBBNZQa5R6rV#",
        "https://www.instagram.com/alginosnt?igsh=MWd6aGdoOXR6b3lvbA%3D%3D&utm_source=qr",
        "https://www.tiktok.com/@alginos.nt?_t=ZN-8yrtS1UVHR0&_r=1"
        ],
        "memberOf": [
        {
            "@type": "Organization",
            "name": "SEB",
            "url": "https://www.seb.lt"
        },
        {
            "@type": "Organization",
            "name": "Luminor",
            "url": "https://www.luminor.lt"
        },
        {
            "@type": "Organization",
            "name": "Swedbank",
            "url": "https://www.swedbank.lt"
        },
        {
            "@type": "Organization",
            "name": "Urbo Bankas",
            "url": "https://www.urbobank.lt"
        }
        ]
    }
    </script>
    @stop

@endif

@section('main')


  <main class="partners_wrap">
       @if(app()->getLocale() == 'lt')  <h2>{{$data[0]->title}}</h2>
       @else <h2>{{$data[0]->title_ru}}</h2>
       @endif

       @if(app()->getLocale() == 'lt')  <p>{{$data[0]->description}}</p>
       @else <p>{{$data[0]->description_ru}}</p>
       @endif

    <div class="partners_block">
   @foreach ($data as $k => $v)


 <div class="block">
            <div class="image">
                <img src="{{asset('storage/partners/'.$v->block_image) }}" alt="">
            </div>
            <div class="info">
                <div class="top">
                   <h3>{{$v->block_title}}</h3>

                      @if(app()->getLocale() == 'lt')  <p>{{$v->block_text}}</p>
                    @else <p>{{$v->block_text_ru}}</p>
                    @endif
                </div>
                @if($v->block_files != '')
                    <button class="send" onclick="window.open('{{asset('storage/partners_files/'.$v->block_files) }}')">{{ __('string.Skaityti daugiau') }}</button>
                @endif
             </div>
        </div>


        @endforeach


    </div>

</main>



@stop

@push('scripts')
<script>


    </script>
  @endpush
