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

  </main>



@stop

@push('scripts')
<script>
  

    </script>
  @endpush