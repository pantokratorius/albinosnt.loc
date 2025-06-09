@extends('layouts.guest')


@section('title', 'Pagrindinis | Alginos NT')

@section('main')

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
          <div class="item">
            <div class="image">
              <img src="{{asset('storage/skelbimai/1-kambario-su-holu-butas-kuncu-g-mogiliovas (4)1709098570.jpg') }}" />
            </div>
            <div class="data">
              <span>ID: 12221</span> | 
              <span>1 kamb.</span> | 
                <span>33 kv.m</span> | 
                  <span>4/5 a.</span> | 
                    <span>1978 m.</span>
            </div>
            <div class="description">
              <h4>1 kamb. butas, Žardininkų g., Klaipėdos m</h4>
              <div class="text">
                Klaipėdoje, Žardininkų g. parduodamas vieno
kambario butas blokinio namo 4/5 aukšte. Be...
              </div>
            </div>
            <div class="price">
              <span>65 000 €</span>
              <button class="more">Plačiau</button>
            </div>
          </div>
          @endforeach
      </div>
  </main>

  <div class="pagination">
    {{ $data->onEachSide(0)->links() }}
  </div>

@stop