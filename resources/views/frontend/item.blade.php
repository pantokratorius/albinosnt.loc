@extends('layouts.frontend')


@section('title', 'Pagrindinis | Alginos NT')

@section('main')

@php

  if(!empty($photos)){
  foreach($photos as $k => $v){
    $photos_links[] = '"' . asset('storage/skelbimai/' . $v) . '"';
  }
}else $photos_links = [];
@endphp

  <main>
    

      <div class="skelbimas_item">
          <div class="left">
       
              <div class="slider-container">
                <button class="arrow left" onclick="prevSlide()">&#10094;</button>
                <img id="mainImage" class="main-image" src="" alt="Товар" onclick="openModal(event)">
                <button class="arrow right" onclick="nextSlide()">&#10095;</button>

                <div class="thumbnails-wrapper">
                  <div class="thumbnails-container">
                    <div class="thumbnails" id="thumbnails"></div>
                  </div>
                </div>



          <div id="imageModal" class="modal" onclick="closeModal(event)">
          <span class="modal-close" onclick="closeModal(event)">&times;</span>
          <div class="modal-content-wrapper" onclick="event.stopPropagation()">
            <span class="nav-button left-button" onclick="prevImage()">&#10094;</span>
            <span class="nav-button right-button" onclick="nextImage()">&#10095;</span>
            <div class="modal-content" onclick="navigatePhoto(event)">
              <img id="modalImg" src="" alt="Увеличенное изображение" >
            </div>
            <div class="modal-thumbnails" id="modalThumbnails"></div>
          </div>
        </div>




              </div>
@if($user_data)
              <div class="manager desktop">
                  <div class="image">
                    <img src="{{asset('storage/vartotojai/' . $user_data['photo']) }}" />
                  </div>
                  <div class="info">
                      <div class="top">
                          <h4>{{$user_data['name']}}</h4> <span class="separator">|</span>
                          <span>Pardavimų vadybininkė</span>
                      </div>
                      <div class="middle">
                          <p>Telefono numeris: <a href="tel:{{$user_data['phone']}}">{{$user_data['phone']}}</a></p>
                          <p>Elektroninis paštas: <a href="mailto:{{$user_data['email']}}">{{$user_data['email']}}</a></p>
                      </div>
                      <button class="send" onclick="openPopup()">Siųsti užklausą</button>
                  </div>
              </div>
@endif
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
                @if(!empty($data->price))
                <tr>
                  <td>Kaina:</td>
                  <td>{{number_format($data->price, 0, ',', ' ')}} €</td>
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
            <p>{{$data->notes_lt }}</p>
        </div>
@if($user_data)
              <div class="manager mobile">
                  <div class="image">
                    <img src="{{asset('storage/vartotojai/' . $user_data['photo']) }}" />
                  </div>
                  <div class="info">
                      <div class="top">
                          <h4>{{$user_data['name']}}</h4> <span class="separator">|</span>
                          <span>Pardavimų vadybininkė</span>
                      </div>
                      <div class="middle">
                          <p>Telefono numeris: <a style="white-space: nowrap"  href="tel:{{$user_data['phone']}}">{{$user_data['phone']}}</a></p>
                          <p>Elektroninis paštas: <a href="mailto:{{$user_data['email']}}">{{$user_data['email']}}</a></p>
                      </div>
                      <button class="send">Siųsti užklausą</button>
                  </div>
              </div>
@endif
         <div class="similar">
          <h3>Panašūs skelbimai</h3>
          <div class="items">
              @foreach($similar as $k => $v)
                <div class="item" @if(session('type') == 'tile') style="display: none" @endif>
                  <div class="image" onclick="location='{{route('nt_item', $v->id)}}'; return false">
                    @if(!empty($image[$v->id]))
                      <img src="{{asset('storage/skelbimai/' . $image[$v->id]) }}" />
                      @else
                      <img src="{{url('timthumb.png') }}" />
                    @endif 
                  </div>
                  <div class="data">
              <span>ID: {{$v->id}}</span>  
           @if($v->roomAmount > 0)<span>{{$v->roomAmount}} kamb.</span>  @endif
                <span>{{$v->size}} kv.m</span>  
                   @if($v->size > 0)<span>{{$v->size}} kv.m</span>  @endif
                     @if($v->floor > 0 ||  ($v->floorNr > 0))
                      <span>{{$v->floor > 0 ? $v->floor : ''}}{{$v->floorNr > 0 ? '/'.$v->floorNr : ''}}a. </span> 
                     @endif
                    @if($v->years > 0)<span>{{$v->years}} m.</span>@endif
            </div>
                  <div class="description">
                    <h4 onclick="location='{{route('nt_item', $v->id)}}'; return false">
                      @if($v->roomAmount > 0){{ $v->roomAmount . ' kamb. '.$itemtype.',' }}@endif @if(isset($streets[$v->id])){{$streets[$v->id]}}@endif @if(isset($city[$v->id])){{$city[$v->id]}}@endif
                    </h4>
                    <div class="text">
                      {{$v->notes_lt}}
                    </div>
                  </div>
                  <div class="price">
                    <span>{{number_format($v->price, 0, ',', ' ')}} €</span>
                    <button class="more" onclick="location='{{route('nt_item', $v->id)}}'; return false">Plačiau</button>
                  </div>
                </div>
                @endforeach
          </div>
      </div>
<input type="hidden" id="item_id" value="{{$data->id}}" >
  </main>
  <div id="middle_view"></div>

@push('scripts')  
<script>

  document.addEventListener('DOMContentLoaded', function(){
    window.scrollTo(0, document.querySelector('.skelbimas_item').offsetTop - 40);
  })


   const images = [ {!! implode(',', $photos_links) !!} ];

  
  const thumbnailsPerView = 4;
  let currentIndex = 0;
  let thumbStartIndex = 0;
  let width = 0;
  let touchStartX = 0;
  let touchEndX = 0;
  
  

  const mainImage = document.getElementById("mainImage");
  const thumbnailsDiv = document.getElementById("thumbnails");
  const modalThumbnails = document.getElementById('modalThumbnails');


  mainImage.addEventListener('touchstart', (e) => {
    touchStartX = e.changedTouches[0].screenX;
  });

  mainImage.addEventListener('touchend', (e) => {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipeGesture();
  });

  function  navigatePhoto(event) {
    const containerWidth = event.currentTarget.offsetWidth;
    const clickX = event.offsetX;

    if (clickX < containerWidth / 2) {
      prevSlide()
    } else {
      nextSlide()
    }

    const modalImg = document.getElementById('modalImg');
    modalImg.src = images[currentIndex] ?? '';

    onThumbnailClick(currentIndex);
    updateModalImage();
  }

  function handleSwipeGesture() {
    const swipeThreshold = 50; 
    const swipeDistance = touchEndX - touchStartX;

    if (Math.abs(swipeDistance) > swipeThreshold) {
      if (swipeDistance > 0) {
        prevSlide(); 
      } else {
        nextSlide(); 
      }
    }
  }

  function renderThumbnails() {
    thumbnailsDiv.innerHTML = "";
    modalThumbnails.innerHTML = '';
    images.forEach((src, index) => {
      const img = document.createElement("img");
      img.src = src;
      img.className = "thumbnail";
      img.dataset.index = index;
      img.onclick = () => onThumbnailClick(index);
      thumbnailsDiv.appendChild(img);
      

         const thumbModal = document.createElement('div');
      thumbModal.className = 'thumbnail';
      thumbModal.style.backgroundImage = `url('${src}')`;
      if (index === currentIndex) thumbModal.classList.add('active');
      thumbModal.onclick = (e) => {
        e.stopPropagation();
        onThumbnailClick(index);
        updateModalImage();
      };
      modalThumbnails.appendChild(thumbModal);
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

  
  function changeImage(index) {
    currentIndex = index;
    document.getElementById('mainImage').style.backgroundImage = `url('${images[index]}')`;

    document.querySelectorAll('.thumbnail').forEach((thumb, i) => {
      thumb.classList.toggle('active', i === index);
    });
  }

  function updateMainImage() {
    if(images[currentIndex])
      mainImage.src = images[currentIndex];
    else mainImage.style.display ="none"
    document.querySelectorAll(".thumbnail").forEach((thumb) => {
      const idx = parseInt(thumb.dataset.index);
      thumb.classList.toggle("active", idx === currentIndex);
    });

      width = Number(getComputedStyle(document.querySelector('.thumbnails img')).width.split('px')[0]) + 10
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

  function prevImage() {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    modalImg.src = images[currentIndex] ?? '';
    onThumbnailClick(currentIndex);
    updateModalImage();
  }

  function nextImage() {
    currentIndex = (currentIndex + 1) % images.length;
    modalImg.src = images[currentIndex] ?? '';
    onThumbnailClick(currentIndex);
    updateModalImage();
  }

  function ensureThumbVisible() {
    if (currentIndex < thumbStartIndex) {
      thumbStartIndex = currentIndex;
    } else if (currentIndex >= thumbStartIndex + thumbnailsPerView) {
      thumbStartIndex = currentIndex - thumbnailsPerView + 1;
    }
    updateThumbScroll();
  }

  function updateModalImage() {
    document.getElementById('modalImg').src = images[currentIndex] ?? '';

    document.querySelectorAll('#modalThumbnails .thumbnail').forEach((thumb, i) => {
      thumb.classList.toggle('active', i === currentIndex);
    });
  }


  function openModal(e) {
    if(getComputedStyle(document.querySelector('#middle_view'), null).display == 'block') {
      navigatePhoto(e)
    }else{
    const modal = document.getElementById('imageModal');
    modalImg.src = images[currentIndex] ?? '';
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden'

    updateModalImage();
    }
  }

  function closeModal(event) {
    if (
      event.target.id === 'imageModal' ||
      event.target.classList.contains('modal-close')
    ) {
      document.getElementById('imageModal').style.display = 'none';
      document.body.style.overflow = 'visible'
    }
  }



  renderThumbnails();
</script>
@endpush


@stop