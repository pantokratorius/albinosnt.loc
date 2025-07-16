@extends('layouts.frontend')


@section('title', 'Pagrindinis | Alginos NT')

@section('main')


  <main class="partners_wrap">
    <h2>Susipažinkite su savo partneriais</h2>
        <p>Bendradarbiaujame su patikimais ir patyrusiais partneriais, kurie dalijasi mūsų įsipareigojimu kokybei, sąžiningumui ir klientų pasitenkinimui. Kartu siekiame teikti išskirtinius nekilnojamojo turto sprendimus ir paslaugas, kuriomis galite pasitikėti.</p>

    <div class="partners_block">
   @foreach ($data as $k => $v)
        

 <div class="block">
            <div class="image">
                <img src="{{asset('storage/partners/'.$v->block_image) }}" alt="">
            </div>
            <div class="info">
                <div class="top">
                    <h3>{{$v->block_title}}</h3>
                    <p>{{$v->block_text}}</p>
                </div>
                <button class="send">Skaityti daugiau</button>
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
