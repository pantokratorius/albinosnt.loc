@extends('layouts.frontend')


@section('title', 'Pagrindinis | Alginos NT')

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
