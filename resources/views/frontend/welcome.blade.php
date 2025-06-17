@extends('layouts.frontend')


@section('title', 'Pagrindinis | Alginos NT')

@section('main')

  

  <main>
      <div class="title">
          <h3>Nekilnojamas Turtas</h3>
          <div class="view">
            Peržiūra
            <img 
                @if(session('type') != 'tile')
                  class="active"
                  src="{{asset('assets/img/grid-svgrepo-com_active.svg')}}"  
                  @else
                  src="{{asset('assets/img/grid-svgrepo-com.svg')}}"  
                  onclick="location='{{route('homepage',['type' => 'simple'])}}'; return false;"
                @endif
                />
            <img 
            @if(session('type') == 'tile')
                  class="active"
                  src="{{asset('assets/img/Vector_sand_active.svg')}}" 
                  @else
                  src="{{asset('assets/img/vector _sand.svg')}}"  
                  onclick="location='{{route('homepage',['type' => 'tile'])}}'; return false;" 
                @endif
            />
          </div>
      </div>

      <div class="items">
       
        @forelse($data as $v)
      @if(session('type') != 'tile') 
          <div class="item" >
            <div class="image" onclick="location='{{route('nt_item', $v->id)}}'; return false">
              @if(isset($photo[$v->id]))<img src="{{asset('storage/skelbimai/' . $photo[$v->id]) }}" />@endif
            </div>
            <div class="data">
              <span>ID: {{$v->id}}</span> | 
           @if($v->roomAmount > 0)<span>{{$v->roomAmount}} kamb.</span> | @endif
                <span>{{$v->size}} kv.m</span> | 
                  <span>{{$v->floor}}/{{$v->floorNr}} a.</span> | 
                    <span>{{$v->years}} m.</span>
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
@else
          <div class="item_block"  >
            <div class="image" onclick="location='{{route('nt_item', $v->id)}}'; return false">
              @if(isset($photo[$v->id]))<img src="{{asset('storage/skelbimai/' . $photo[$v->id]) }}" />@endif
            </div>
            <div class="data_wrap">
              
              <div class="description">
                <div>
                  <h4 onclick="location='{{route('nt_item', $v->id)}}'; return false">{{$v->roomAmount}} butas, {{$v->streets}} g., {{$v->city}}</h4>
                  <div class="data">
                  <span>ID: {{$v->id}}</span> | 
              @if($v->roomAmount > 0)<span>{{$v->roomAmount}} kamb.</span> | @endif
                    <span>{{$v->size}} kv.m</span> | 
                      <span>{{$v->floor}}/{{$v->floorNr}} a.</span> | 
                        <span>{{$v->years}} m.</span>
                </div>
                  <div class="text">
                    {{$v->notes_lt}}
                  </div>
                  </div>
                  <div>
                  <div class="price">
                    <span>{{number_format($v->price, 0, ',', ' ')}} €</span>
                  </div>
                  </div>
              </div>
            </div>
          </div>
          @endif
          @empty
            <div class="item_block" >
                <h3>Įrašų nerasta</h3>
            </div>
          @endforelse
      </div>
  </main>

  <div class="pagination">
    {{ $data->onEachSide(0)->links() }}
  </div>

@stop