@extends('layouts.frontend')


@section('title', 'Pagrindinis | Alginos NT')

@section('main')


  <main>
      <div class="title">
          <h3>Nekilnojamas Turtas @if(!empty($itemtype)) | {{$submenu[$itemtype]}}@endif</h3> 
          <div class="view">
            Peržiūra
            <img 
                @if(session('type') != 'tile')
                  class="active"
                  src="{{asset('assets/img/grid-svgrepo-com_active.svg')}}"  
                  @else
                  src="{{asset('assets/img/grid-svgrepo-com.svg')}}"  
                  onclick="location='{{ request()->fullUrlWithQuery(['type' => 'simple']) }}'; return false;"
                @endif
                />
            <img 
            @if(session('type') == 'tile')
                  class="active"
                  src="{{asset('assets/img/Vector_sand_active.svg')}}" 
                  @else
                  src="{{asset('assets/img/vector _sand.svg')}}"  
                  onclick="location='{{ request()->fullUrlWithQuery(['type' => 'tile']) }}'; return false;" 
                @endif
            />
          </div>
      </div>

      <div class="items">
       
        @forelse($data as $v)
      @if(session('type') != 'tile') 
          <div class="item desktop2" >
            <div class="image" onclick="location='{{route('nt_item', $v->id)}}'; return false">
              @if(isset($photo[$v->id]))<img src="{{asset('storage/skelbimai/' . $photo[$v->id]) }}" />@endif
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
@else
          <div class="item_block desktop2"  >
            <div class="image" onclick="location='{{route('nt_item', $v->id)}}'; return false">
              @if(isset($photo[$v->id]))<img src="{{asset('storage/skelbimai/' . $photo[$v->id]) }}" />@endif
            </div>
            <div class="data_wrap">
              
              <div class="description">
                <div>
                  <h4 onclick="location='{{route('nt_item', $v->id)}}'; return false">{{$v->roomAmount}} butas, {{$v->streets}} g., {{$v->city}}</h4>
                  <div class="data">
                  <span>ID: {{$v->id}}</span>  
              @if($v->roomAmount > 0)<span>{{$v->roomAmount}} kamb.</span>  @endif
                    @if($v->size > 0)<span>{{$v->size}} kv.m</span>  @endif
                     @if($v->floor > 0 ||  ($v->floorNr > 0))
                      <span>{{$v->floor > 0 ? $v->floor : ''}}{{$v->floorNr > 0 ? '/'.$v->floorNr : ''}}a. </span> 
                     @endif
                       @if($v->years > 0) <span>{{$v->years}} m.</span>@endif
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
          <div class="item mobile2" >
            <div class="image" onclick="location='{{route('nt_item', $v->id)}}'; return false">
              @if(isset($photo[$v->id]))<img src="{{asset('storage/skelbimai/' . $photo[$v->id]) }}" />@endif
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
          @empty
            <div class="item_block" >
                <h3 class="no_items">Įrašų nerasta</h3>
            </div>
          @endforelse
      </div>
  </main>

  <div class="pagination">
    {{ $data->onEachSide(0)->links() }}
  </div>

@stop

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function(){
      if(location.search.indexOf('page=') +1)
          window.scrollTo(0, document.querySelector('main').offsetTop);
        })
          // document.addEventListener('DOMContentLoaded', function(){
          //   const count = 250
          //     document.querySelectorAll('.item .description .text').forEach(item => {
          //       if( item.textContent.length > count){
          //         item.textContent =  item.textContent.substr(0, count).split(' ').slice(0, -1).join(' ')
          //          isLastCharPunctuationOrSpecialChar( item.textContent.substr(0, 250).split(' ').slice(0, -1).join(' ')) ?
          //           item.textContent = item.textContent.substr(0, 250).split(' ').slice(0, -1).join(' ').slice(0, -1) :
          //           item.textContent = item.textContent.substr(0, 250).split(' ').slice(0, -1).join(' ')
          //       }
          //     })
          //   })


          //   function isLastCharPunctuationOrSpecialChar(inputString) {
          //     var regex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+$/;

          //     return regex.test(inputString.charAt(inputString.length - 1));
          //   }

    </script>
  @endpush