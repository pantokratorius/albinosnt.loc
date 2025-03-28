@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'NT Modulis')
@section('content_header_subtitle', 'Objekto redagavimas')
{{-- Content body: main page content --}}
@section('content_body')

@include('MyComponents.error')
@include('MyComponents.alert')
<div class="card-body">
    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Naujas vadybininkas</a>
        </li>
      </ul>
      <div class="tab-content" id="custom-content-below-tabContent">
        <div class="tab-pane fade active show" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
          <div class="butas tipas">
              <form method="post" enctype="multipart/form-data" action="" id="addFrom">
                  @csrf
                  <ul>
                      <li><label>Vardas</label>
                        <input type="text" name="name" value="{{old('name')}}" />
                      </li>
                      <li><label>Pavardė</label>
                        <input type="text" name="last_name" value="{{old('last_name')}}" />
                      </li>
                      <li><label>Slaptažodis</label>
                        <input type="password" name="password" value="" />
                      </li>
                      <li><label>Pakartoti slaptažodį</label>
                        <input type="password" name="password_confirmation" value="" />
                      </li>
                      <li><label>Telefono numeris</label>
                        <input type="text" name="phone" value="{{old('phone')}}" />
                      </li>
                      <li><label>E-mailas</label>
                        <input type="email" name="email" value="{{old('email')}}" />
                      </li>
                      <li><label>Vartotojų grupė</label>
                        <select name="role">
                            <option value="">Pasirinkite</option>
                            @foreach($permissions as $v)
                                <option value="{{$v}}" @if(old('role') == $v) selected @endif>{{$v}}</option>
                            @endforeach
                        </select>
                      </li>
                      <hr/>
                      <li><label>Nuotrauka</label>
                        <span class="block">
                            <input accept=".jpg,.gif,.png" name="photo" type="file">
                        </span>
                    </li>
                    <br>
                      <li>@include('MyComponents.submit')</li>
                  </ul></form>
          </div>
        </div>
      </div>

</div>





@stop

{{-- Push extra CSS --}}

@push('css')
<style>

.card-body .nav-item {
    display: flex;
}
.card-body .nav-link {
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    align-items: center;
}

.alert {
    width: fit-content;
}

.alert-dismissible {
    width: fit-content;
}
    label.show {
        margin-left: 10px;
    }

    .block {
            display: inline-block;
            width: 80%;
        }
    .block ul {
        display: flex;
        flex-wrap: wrap;
    }
    .block ul li{
        margin-bottom: 1%;
        white-space: nowrap;
    }
    
    .block ul li:not(.nav-item) {
        width: 20%;
    }

    li label {
        white-space: nowrap
    }

    .block ul li label{
        cursor: pointer;
        vertical-align: middle;
    }
    .block ul li input[type=checkbox] {
        margin-right: 5px;
    }

   div[id^='custom-content-below-']{
        margin: 30px 0;
    }

    label {
        width: 200px;
    }

    select, input[type="text"]{
        min-width: 200px
    }

    textarea {
        padding: 2px 5px; 
    }

    .message {
        margin-left: 10px;
        color: #cd0e0e;
        font-weight: bold;
    }



</style>
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script>

        $('#addFrom').submit(function(){ 
            [first, second] = $('input[name="password"]')
            if((first.value != '' || second.value != '') && first.value != second.value){
                const mess = 'Slaptažodžiai nesutampa!'
                $(second).after(`<span class="message">${mess}</span>`)
                return false
            }
        })

        $(function(){
     



        })


    </script>
@endpush
