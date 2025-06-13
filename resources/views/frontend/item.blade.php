@extends('layouts.frontend')


@section('title', 'Pagrindinis | Alginos NT')

@section('main')

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

          </div>
          <div class="right">

          </div>


            {{-- <div class="image">
              @if(isset($photos[$data->id]))<img src="{{asset('storage/skelbimai/' . $photos[$data->id]) }}" />@endif
            </div> --}}
        </div>

  </main>


  
<script>
   const images = [ {!! implode(',', $photos_links) !!} ];

  const thumbnailsPerView = 4;
  let currentIndex = 0;
  let thumbStartIndex = 0;

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
  }

  function scrollThumbs(direction) {
    thumbStartIndex += direction;
    const maxStart = images.length - thumbnailsPerView;
    if (thumbStartIndex < 0) thumbStartIndex = 0;
    if (thumbStartIndex > maxStart) thumbStartIndex = maxStart;
    updateThumbScroll();
  }

  function updateThumbScroll() {
    const offset = thumbStartIndex * 154; // thumbnail width + margin
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

<style>
  
    .slider-container {
      position: relative;
      max-width: 600px;
      margin: 0 auto;
    }

    .main-image {
      width: 100%;
      height: 610px;
      object-fit: cover;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    .arrow {
      position: absolute;
      top: 50%;
      transform: translateY(-120%);
      background: transparent;
      color: white;
      border: none;
      padding: 10px 15px;
      cursor: pointer;
      font-size: 24px;
      border-radius: 50%;
      z-index: 10;
    }

    .arrow.left { left: 10px; }
    .arrow.right { right: 10px; }

    .thumbnails-wrapper {
      margin-top: 20px;
      display: flex;
      align-items: center;
      justify-content: flex-start;
    }



    .thumbnails-container {
      overflow: hidden;
      width: 100%;
    }

    .thumbnails {
      display: flex;
      transition: transform 0.4s ease;
    }

    .thumbnail {
      width: 23.8%;
      height: 105px;
      object-fit: cover;
      margin-right: 10px;
      border-radius: 4px;
      border: 2px solid transparent;
      cursor: pointer;
      flex-shrink: 0;
    }

    .thumbnail.active {
      border: 2px solid #C09062;
    }

    @media (max-width: 480px) {
      .thumbnail {
        width: 60px;
        height: 45px;
      }

      .thumbnails-container {
        width: 100%;
      }
    }
  </style>



@stop