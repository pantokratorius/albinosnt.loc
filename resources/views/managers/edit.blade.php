@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'NT Modulis')
@section('content_header_subtitle', 'Objekto redagavimas')
{{-- Content body: main page content --}}
@section('content_body')

@include('MyComponents.error')

<div class="card-body">
    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Vadybininko redagavimas</a>
        </li>
      </ul>
      <div class="tab-content" id="custom-content-below-tabContent">
        <div class="tab-pane fade active show" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
          <div class="butas tipas">
              <form method="post" enctype="multipart/form-data" action="" >
                  @csrf
                  <input name="itemType" hidden="hidden" value="butas"/>
                  <ul>
                    <li><label>Aktyvus</label>
                        <select name="active">
                            <option value="">Pasirinkite</option>
                            <option value="1" @if ($data->active == 1)
                                selected
                            @endif>Taip</option>
                            <option value="0" @if ($data->active == 0)
                                selected
                            @endif>Ne</option>
                        </select>
                      </li>
                    <li><label>Vardas</label>
                        <input type="text" name="name" value="{{$data->name}}" />
                      </li>
                      <li><label>Pavardė</label>
                        <input type="text" name="last_name" value="{{$data->last_name}}" />
                      </li>
                      <li><label>Slaptažodis</label>
                        <input type="password" name="password" value="" />
                      </li>
                      <li><label>Pakartoti slaptažodį</label>
                        <input type="password" name="password_confirmation" value="" />
                      </li>
                      <li><label>Telefono numeris</label>
                        <input type="text" name="phone" value="{{$data->phone}}" />
                      </li>
                      <li><label>E-mailas</label>
                        <input type="email" name="email" value="{{$data->email}}" />
                      </li>
                      <li><label>Vartotojų grupė</label>
                        <select name="role">
                            <option value="">Pasirinkite</option>
                            @foreach($permissions as $v)
                                <option value="{{$v}}" @if($role == $v) selected @endif>{{$v}}</option>
                            @endforeach
                        </select>
                      </li>
                      <hr/>
                      <li>
                        <label>Nuotraukos</label>
                      <span class="block">
                          <input multiple="true" name="photo" type="file">
                      </span>
                        <div style="margin: 20px 0 0 120px">
                            @if($data->photo)
                                <ul style="display: flex; flex-wrap: wrap;" id="photo_container">
                                    <li style="position: relative">
                                        <img src="{{asset('storage/vartotojai/' . $data->photo) }}" style="max-height: 200px; padding: 2px" data-path="{{ $data->photo }}"/>
                                        <span class="delete_image">&times;</span>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </li>
                    <br>
                      <hr/>
                      <li>@include('MyComponents.submit')</li>
                  </ul>
                </form>
          </div>
        </div>
      </div>
</div>





@stop

{{-- Push extra CSS --}}

@push('css')
<style>

.delete_image {
    position: absolute; 
    color: #c10000; 
    right: 5%; 
    top: 3%; 
    cursor: pointer; 
    font-size: 21px;
    border: 1px dotted #ff9090;
    height: 15px;
    line-height: 13px;
}
.card-body .nav-item {
    display: flex;
}
.card-body .nav-link {
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    align-items: center;
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



</style>
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script>


        $('.delete_image').click(function(){
            const el = $(this)
            const id = {{ $data->id }};

           const photo = $('#photo_container li img').data('path')

            if(confirm('Ar tikrai trinti?')){
                $.ajax({
                        url:`/admin/manager/removeImage`,
                        type:"POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{ photo, id },
                        success: function(data){
                            el.closest('li').remove()
                        }
                    })
                    
            }
        })




    </script>
@endpush
