@extends('layouts.frontend')


@section('title', 'Pagrindinis | Alginos NT')

@section('main')


  <main class="services_wrap">
     
       <h2>Mūsų Paslaugos</h2>
        <p>Teikiame išsamius nekilnojamojo turto paslaugų sprendimus, kad padėtume jums kiekviename etape – nesvarbu, ar perkate, parduodate, nuomojate, ar ieškote finansavimo galimybių. Mūsų patyrusi komanda pasiruošusi užtikrinti sklandų ir sėkmingą procesą nuo pradžios iki pabaigos</p>

    <div class="services_block">


        <div class="block">
          <img src="{{asset('storage/services/Vector (9).svg') }}" alt="">
          <h3>Banko Paskolos</h3>
          <p>Padedame sutvarkyti paskolos klausimus visuose pagrindiniuose bankuose.</p>
          <ul>
            <li>Konsultuojame dėl paskolų galimybių</li>
            <li>Konsultuojame dėl paskolų galimybių</li>
            <li>Konsultuojame dėl paskolų galimybių</li>
          </ul>
        </div>
        <div class="block">
          <img src="{{asset('storage/services/reklama.svg') }}" alt="">
          <h3>Parduodamo NT reklama</h3>
          <p>Rengiame profesionalius skelbimus, kad Jūsų turtas būtų parduotas greitai ir efektyviai.</p>
          <ul>
            <li>Paruošiame nuotraukas, planus ir aprašymus</li>
            <li>Skelbiame pagrindiniuose NT portaluose ir leidiniuose</li>
            <li>Įrengiame reklaminę iškabą prie objekto (jei reikia)</li>
          </ul>
        </div>
        <div class="block">
          <img src="{{asset('storage/services/thumbs.svg') }}" alt="">
          <h3>Derybų vykdymas</h3>
          <p>Atstovaujame Jūsų interesus viso sandorio metu.</p>
          <ul>
            <li>Deramės dėl kainos ir sutarties sąlygų</li>
            <li>Ruošiame dokumentus pasirašymui</li>
            <li>Organizuojame sandorio tvirtinimą pas notarą</li>
          </ul>
        </div>
        <div class="block">
          <img style="width: 16%" src="{{asset('storage/services/care.svg') }}" alt="">
          <h3>Konsultacijos ir investicijos</h3>
          <p>Teikiame profesionalias konsultacijas NT ir investavimo klausimais.</p>
          <ul>
            <li>Konsultuojame dėl investicinių projektų</li>
            <li>Tarpininkaujame įgyvendinant investicijas</li>
          </ul>
        </div>
        <div class="block">
          <img src="{{asset('storage/services/files (2).svg') }}" alt="">
          <h3>Dokumentų paruošimas</h3>
          <p>Rūpinamės, kad visi dokumentai būtų teisingi ir tvarkingi.</p>
          <ul>
            <li>Surenkame reikiamus dokumentus</li>
            <li>Tikriname jų teisėtumą ir autentiškumą</li>
          </ul>
        </div>
  



    </dv>

  </main>



@stop

@push('scripts')
<script>
  

    </script>
  @endpush