@extends('layouts.frontend')


@section('title', 'Pagrindinis | Alginos NT')

@section('main')
<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

@php
  $photos_links = [];
  foreach($photos as $k => $v){
    $photos_links[] = '"' . asset('storage/skelbimai/' . $v) . '"';
  }
@endphp

  <main>
    

      <div class="skelbimas_item">
          <div class="left">
       
              <div class="slider-container">
                <button class="arrow left" onclick="prevSlide()">&#10094;</button>
                <img id="mainImage" class="main-image" src="" alt="Товар">
                <button class="arrow right" onclick="nextSlide()">&#10095;</button>

                <div class="thumbnails-wrapper">
                  <div class="thumbnails-container">
                    <div class="thumbnails" id="thumbnails"></div>
                  </div>
                </div>
              </div>

              <div class="manager">
                  <div class="image">
                    <img src="{{asset('storage/vartotojai/' . $user_data['photo']) }}" />
                  </div>
                  <div class="info">
                      <div class="top">
                          <h4>Algina Mickienė</h4>
                          <p>Pardavimų vadybininkė</p>
                      </div>
                      <div class="middle">
                          <p>Telefono numeris: <a href="tel:+370 604 50021">+370 604 50021</a></p>
                          <p>Elektroninis paštas: <a href="mail:info@alginosnt.lt">info@alginosnt.lt</a></p>
                      </div>
                      <button class="send">Siųsti užklausą</button>
                  </div>
              </div>

          </div>
          <div class="right">
              <h2>Informacija</h2>
              <table>
                <tr>
                  <td>Savivaldybė:</td>
                  <td>{{$region}}</td>
                </tr>
                @if(!empty($quarter))
                <tr>
                  <td>Mikrorajonas:</td>
                  <td>{{$quarter}}</td>
                </tr>
                @endif
                @if(!empty($city))
                <tr>
                  <td>Miestas:</td>
                  <td>{{$city}}</td>
                </tr>
                @endif
                @if(!empty($streets))
                <tr>
                  <td>Gatvė:</td>
                  <td>{{$streets}}</td>
                </tr>
                @endif
                @if(!empty($streets))
                <tr>
                  <td>Plotas:</td>
                  <td>{{$data->size}} Kv. M.</td>
                </tr>
                @endif
                @if(!empty($streets))
                <tr>
                  <td>Aukštas:</td>
                  <td>{{$data->floor}}/{{$data->floorNr}}</td>
                </tr>
                @endif
                @if(!empty($data->years))
                <tr>
                  <td>Pastatymo metai:</td>
                  <td>{{$data->years}}</td>
                </tr>
                @endif
                @if(!empty($data->roomAmount))
                <tr>
                  <td>Kambarių sk.:</td>
                  <td>{{$data->roomAmount}}</td>
                </tr>
                @endif
                @if(!empty($data->buildType))
                <tr>
                  <td>Pastato tipas:</td>
                  <td>{{$data->buildType}}</td>
                </tr>
                @endif
                @if(!empty($data->equipment))
                <tr>
                  <td>Įrengimas:</td>
                  <td>{{$data->equipment}}</td>
                </tr>
                @endif
                @if(!empty($data->heating))
                <tr>
                  <td>Šildymas:</td>
                  <td>{{ str_replace(';', ', ',$data->heating) }}</td>
                </tr>
                @endif
                @if(!empty($data->addOptions))
                <tr>
                  <td>Ypatybės:</td>
                  <td>{{ str_replace(';', ', ',$data->addOptions) }}</td>
                </tr>
                @endif
                @if(!empty($data->addEquipment))
                <tr>
                  <td>Papildoma įranga:</td>
                  <td>{{ str_replace(';', ', ',$data->addEquipment) }}</td>
                </tr>
                @endif
                @if(!empty($data->security))
                <tr>
                  <td>Apsauga:</td>
                  <td>{{ str_replace(';', ', ',$data->security) }}</td>
                </tr>
                @endif
              </table>
          </div>


            {{-- <div class="image">
              @if(isset($photos[$data->id]))<img src="{{asset('storage/skelbimai/' . $photos[$data->id]) }}" />@endif
            </div> --}}
        </div>
        <div class="desc">
            <h3>Aprašymas</h3>
            <p>{{ $data->notes_lt }}</p>
        </div>

  </main>


@push('scripts')  
<script>
   const images = [ {!! implode(',', $photos_links) !!} ];

  const thumbnailsPerView = 4;
  let currentIndex = 0;
  let thumbStartIndex = 0;
  let width = 0;
  

  const mainImage = document.getElementById("mainImage");
  const thumbnailsDiv = document.getElementById("thumbnails");

  function renderThumbnails() {
    thumbnailsDiv.innerHTML = "";
    images.forEach((src, index) => {
      const img = document.createElement("img");
      img.src = src;
      img.className = "thumbnail";
      img.dataset.index = index;
      img.onclick = () => onThumbnailClick(index);
      thumbnailsDiv.appendChild(img);
      
      
    });
    updateMainImage();
    updateThumbnailsUI();
    updateThumbScroll();
  }

  function onThumbnailClick(index) {
    currentIndex = index;
    updateMainImage();
    if (index === thumbStartIndex) {
      scrollThumbs(-1);
    } else if (index === thumbStartIndex + thumbnailsPerView - 1) {
      scrollThumbs(1);
    }
  }

  function updateMainImage() {
    mainImage.src = images[currentIndex];
    document.querySelectorAll(".thumbnail").forEach((thumb) => {
      const idx = parseInt(thumb.dataset.index);
      thumb.classList.toggle("active", idx === currentIndex);
    });

      width = Number(getComputedStyle(document.querySelector('.thumbnails img')).width.split('px')[0]) + 10
      console.log(width);
  }

  function scrollThumbs(direction) {
    thumbStartIndex += direction;
    const maxStart = images.length - thumbnailsPerView;
    if (thumbStartIndex < 0) thumbStartIndex = 0;
    if (thumbStartIndex > maxStart) thumbStartIndex = maxStart;
    updateThumbScroll();
  }

  function updateThumbScroll() {
    const offset = thumbStartIndex * width; // thumbnail width + margin
    thumbnailsDiv.style.transform = `translateX(-${offset}px)`;
    updateThumbnailsUI();
  }

  function updateThumbnailsUI() {
    document.querySelectorAll(".thumbnail").forEach((thumb, idx) => {
      thumb.classList.toggle("active", idx === currentIndex);
    });
  }

  function nextSlide() {
    currentIndex = (currentIndex + 1) % images.length;
    ensureThumbVisible();
    updateMainImage();
  }

  function prevSlide() {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    ensureThumbVisible();
    updateMainImage();
  }

  function ensureThumbVisible() {
    if (currentIndex < thumbStartIndex) {
      thumbStartIndex = currentIndex;
    } else if (currentIndex >= thumbStartIndex + thumbnailsPerView) {
      thumbStartIndex = currentIndex - thumbnailsPerView + 1;
    }
    updateThumbScroll();
  }

  renderThumbnails();
</script>
@endpush


@stop