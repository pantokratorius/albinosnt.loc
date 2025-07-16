@extends('layouts.frontend')


@section('title', 'Pagrindinis | Alginos NT')

@section('main')


  <main class="services_wrap">
     
       <h2>{{$data[0]->title}}</h2>
        {!!$data[0]->description!!}

    <div class="services_block">

      @foreach ($data as $k => $v)
        
        <div class="block">
          <img src="{{asset('storage/services/'.$v->block_image) }}" alt=""> 
          <h3>{{$v->block_title}}</h3>
            {!!$v->block_text!!}
        </div>
        @endforeach

    </dv>

  </main>



@stop

@push('scripts')
<script>
  

    </script>
  @endpush