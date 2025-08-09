@extends('layouts.frontend')


@section('title', 'Pagrindinis | Alginos NT')

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
