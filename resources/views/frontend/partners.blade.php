@extends('layouts.frontend')


@section('title', 'Pagrindinis | Alginos NT')

@section('main')


  <main class="partners_wrap">
    <h2>Susipažinkite su savo partneriais</h2>
        <p>Bendradarbiaujame su patikimais ir patyrusiais partneriais, kurie dalijasi mūsų įsipareigojimu kokybei, sąžiningumui ir klientų pasitenkinimui. Kartu siekiame teikti išskirtinius nekilnojamojo turto sprendimus ir paslaugas, kuriomis galite pasitikėti.</p>

    <div class="partners_block">
  
        <div class="block">
            <div class="image">
                <img src="{{asset('storage/partners/SEB.png') }}" alt="">
            </div>
            <div class="info">
                <div class="top">
                    <h3>SEB</h3>
                    <p>Mūsų patikimas partneris SEB siūlo patikimus finansinius sprendimus, padedančius klientams lengvai ir užtikrintai tvarkyti nekilnojamojo turto finansavimą.</p>
                </div>
                <button class="send">Skaityti daugiau</button>
             </div>
        </div>
        <div class="block">
            <div class="image">
                <img src="{{asset('storage/partners/Luminor.png') }}" alt="">
            </div>
            <div class="info">
                <div class="top">
                    <h3>Luminor</h3>
                    <p>Mūsų finansinis partneris Luminor siūlo šiuolaikinius bankininkystės sprendimus ir NT finansavimo galimybes, pritaikytas individualiems klientų poreikiams.</p>
                </div>
                <button class="send">Skaityti daugiau</button>
             </div>
        </div>
        <div class="block">
            <div class="image">
                <img src="{{asset('storage/partners/swed.png') }}" alt="">
            </div>
            <div class="info">
                <div class="top">
                    <h3>Swedbank</h3>
                    <p>Mūsų partneris Swedbank teikia patikimas finansines konsultacijas ir lanksčius būsto paskolų sprendimus, palengvinančius NT pirkimo procesą.</p>
                </div>
                <button class="send">Skaityti daugiau</button>
             </div>
        </div>
        <div class="block">
            <div class="image">
                <img src="{{asset('storage/partners/MB.png') }}" alt="">
            </div>
            <div class="info">
                <div class="top">
                    <h3>Medicinos Bankas</h3>
                    <p>Mūsų partneris Medicinos Bankas teikia individualius bankininkystės ir paskolų sprendimus, padedančius klientams priimti išmanius ir saugius investicinius sprendimus NT srityje.</p>
                </div>
                <button class="send">Skaityti daugiau</button>
             </div>
        </div>
        
        
       
    </div>

</main>



@stop

@push('scripts')
<script>


    </script>
  @endpush
