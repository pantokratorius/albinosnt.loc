@extends('layouts.frontend')


@section('title', 'Pagrindinis | Alginos NT')

@section('main')

  <div class="search_block">
    <form action="search_filter" method="post" >
      <div class="content">
        <div class="column">
            <select>
              <option value="">Aukštas nuo</option>
              @foreach(range(1,100) as $v)
                <option value="{{$v}}">{{$v}}</option>
              @endforeach
            </select>
            <div class="from_to">
              Plotas 
              <input type="text" placeholder="nuo">
              <input type="text" placeholder="iki">
              m
            </div>
            <select>
                <option value="">Tipas</option>
            </select>
        </div>
        <div class="column">
            <select>
              <option value="">Aukštas iki</option>
              @foreach(range(1,100) as $v)
                <option value="{{$v}}">{{$v}}</option>
              @endforeach
            </select>
            <div class="from_to">
                Kaina 
              <input type="text" placeholder="nuo">
              <input type="text" placeholder="iki">
              &euro;
            </div>
            <select>
                <option value="">Šildymas</option>
            </select>
        </div>
        <div class="column">
            <select>
              <option value="">Kambariai nuo</option>
              @foreach(range(1,100) as $v)
                <option value="{{$v}}">{{$v}}</option>
              @endforeach
            </select>
            <select>
              <option value="">Metai nuo</option>
              @foreach(range(1,100) as $v)
                <option value="{{$v}}">{{$v}}</option>
              @endforeach
            </select>
            <select>
              <option value="">Irengimas</option>
              @foreach(range(1,100) as $v)
                <option value="{{$v}}">{{$v}}</option>
              @endforeach
            </select>
        </div>
        <div class="column">
            <select>
              <option value="">Kambariai iki</option>
              @foreach(range(1,100) as $v)
                <option value="{{$v}}">{{$v}}</option>
              @endforeach
            </select>
            <select>
              <option value="">Metai iki</option>
              @foreach(range(1,100) as $v)
                <option value="{{$v}}">{{$v}}</option>
              @endforeach
            </select>
            <label class="with_photos">
              <input type="checkbox" /> Su nuotraukomis
            </label>
        </div>
      </div>
      <div class="button_search">
        <input type="submit" name="submit" value="Ieškoti" />
      </div>
      </form>
  </div>

  <main>
      <div class="title">
          <h3>Nekilnojamas Turtas</h3>
          <div class="view">
            Peržiūra
            <img src="{{asset('assets/img/grid-svgrepo-com.svg')}}" />
            <img src="{{asset('assets/img/vector _sand.svg')}}" />
          </div>
      </div>

      <div class="items">
       
        @foreach($data as $v)
          <div class="item" style="display: none">
            <div class="image">
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
              <h4>1 kamb. butas, Žardininkų g., Klaipėdos m</h4>
              <div class="text">
                {{$v->notes_lt}}
              </div>
            </div>
            <div class="price">
              <span>65 000 €</span>
              <button class="more">Plačiau</button>
            </div>
          </div>

          <div class="item_block">
            <div class="image" onclick="location='{{route('nt_item', $v->id)}}'">
              @if(isset($photo[$v->id]))<img src="{{asset('storage/skelbimai/' . $photo[$v->id]) }}" />@endif
            </div>
            <div class="data_wrap">
              
              <div class="description">
                <div>
                  <h4>1 kamb. butas, Žardininkų g., Klaipėdos m</h4>
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
                    <span>65 000 €</span>
                  </div>
                  </div>
              </div>
            </div>
          </div>
          @endforeach
      </div>
  </main>

  <div class="pagination">
    {{ $data->onEachSide(0)->links() }}
  </div>

@stop