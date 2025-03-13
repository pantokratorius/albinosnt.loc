@php
    
    $features = [
        1 => 'Kraštinis sklypas',
            'Greta miško',
            'Asfaltuotas privažiavimas',
            'Elektra',
            'Dujos',
            'Internetas',
            'Kabelinė televizija',
        ];


$additional_premises = [
   1 => 'Baseinas',
        'Balkonas',
        'Garažas',
        'Pirtis',
        'Drabužinė',
        'Rūsys',
        'Ūkiniai pastatai',
        'Terasa',
        'Automobilio pastogė',
];

@endphp


@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'NT Modulis')
@section('content_header_subtitle', 'Objekto redagavimas')
{{-- Content body: main page content --}}

@section('content_body')
<div class="card-body">
    <h4>Pasirinkite objekto tipa</h4>
    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="custom-content-below-namas-tab" data-toggle="pill" href="#custom-content-below-namas" role="tab" aria-controls="custom-content-below-namas" aria-selected="true">Namas</a>
      </li>
    </ul>
    <div class="tab-content" id="custom-content-below-tabContent">
<div class="tab-pane fade active show" id="custom-content-below-namas" role="tabpanel" aria-labelledby="custom-content-below-namas-tab">

    <div class="namas tipas">
        <form method="post" enctype="multipart/form-data" action="">
            @csrf
            <input name="itemType" hidden="hidden" value="namas"/>
            <ul>
                <li><label>Pasirinkite veiksmą</label>
                    <select name="sellAction">
                        <option value="1" selected="selected">Pasirinkite</option>
                        <option value="1">Pardavimui</option>
                        <option value="2">Nuomai</option>
                    </select>
                </li>
                <hr/>
                <li><label>Savivaldybė</label>
                    <select name="region">
                        <option value="">Pasirinkite</option>
                        @foreach ($savivaldybe as $k => $v)
                            <option value="{{$v->id}}">{{$v->vietove_name}}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Gyvenvietė</label>
                    <select name="city">
                        <option value="">Pasirinkite</option>
                    </select>
                </li>
                <li><label>Mikrorajonas</label>
                    <select name="quarter">
                        <option value="">Pasirinkite</option>
                    </select>
                </li>
                <li><label>Gatvė</label>
                    <select name="streets">
                        <option value="">Pasirinkite</option>
                    </select>
                </li>
                <li><label>Namo numeris</label>
                    <input type="text" name="houseNr" /> <label class="form-check-label show"><input type="checkbox" name="showHouseNr" /> Rodyti</label>
                </li>
                <hr/>
                <li><label>Plotas (m²)</label>
                    <input type="text" name="size" />
                </li>
                <li><label>Sklypo plotas (a)</label>
                    <input type="text" name="landSize" />
                </li>
                <li><label>Metai</label>
                    <input type="text" name="years" />
                </li>
                <li><label>Tipas</label>
                    <input type="text" name="sellType" />
                </li>
                <li><label>Pastato tipas</label>
                    <select name="buildType">
                        <option value="">Pasirinkite</option>
                        @foreach ($buildType as $k => $v)
                            <option value="{{$k}}">{{$v}}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Įrengimas</label>
                    <select name="equipment">
                        <option value="">Pasirinkite</option>
                        @foreach ($equipment as $k => $v)
                            <option value="{{$k}}">{{$v}}</option>
                        @endforeach
                    </select>
                </li>
                <hr>
                <li><label>Kambarių sk.</label>
                    <select name="roomAmount">
                        <option value="">Pasirinkite</option>
                        @foreach (range(1, 100) as $v)
                            <option value="{{$v}}">{{$v}}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Aukštas</label>
                    <select name="floor">
                        <option value="">Pasirinkite</option>
                        @foreach (range(1, 100) as $v)
                            <option value="{{$v}}">{{$v}}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Aukštų sk.</label>
                    <select name="floorNr">
                        <option value="">Pasirinkite</option>
                        @foreach (range(1, 100) as $v)
                            <option value="{{$v}}">{{$v}}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Artimiausias vandens telkinys</label>
                    <select name="waterSource">
                        <option value="">Pasirinkite</option>
                        @foreach ($reservoir as $v)
                            <option value="{{$v}}">{{$v}}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Artimiausias vandens telkinys</label>
                    <input type="text" name="waterDistance" />
                </li>
                
            
             
                <hr/>
                <li><label>Šildymas</label>
                    <span class="block">
                        <ul>
                            @foreach ($heating as $k => $v)
                                <li>
                                    <label class="form-check-label"><input type="checkbox" name="heating[]" value="{{$v}}">{{ $v }}
                                </label></li>
                            @endforeach
                        </ul>
                    </span>
                </li>
                <hr/>
                <li><label>Vanduo</label>
                    <span class="block">
                        <ul>
                            @foreach ($water as $k => $v)
                                <li>
                                    <label class="form-check-label"><input type="checkbox" name="heating[]" value="{{$v}}">{{ $v }}
                                </label></li>
                            @endforeach
                        </ul>
                    </span>
                </li>
                <hr/>
                <li><label>Ypatybės</label>
                    <span class="block">
                        <ul>
                            @foreach ($features as $k => $v)
                                <li><label class="form-check-label"><input type="checkbox" name="addOptions[]" value="{{ $v }}">{{ $v }}</label></li>
                            @endforeach
                        </ul>
                    </span>
                </li>
                <hr/>
                <li><label>Papildomos patalpos</label>
                    <span class="block">
                        <ul>
                            @foreach ($additional_premises as $k => $v)
                                <li><label class="form-check-label"><input type="checkbox" name="addRooms[]" value="{{ $v }}">{{ $v }}</label></li>
                            @endforeach
                        </ul>
                    </span>
                </li>
                <hr/>
                <li><label>Papildoma įranga</label>
                    <span class="block">
                        <ul>
                            @foreach ($additional_equipment as $k => $v)
                                <li><label class="form-check-label"><input type="checkbox" name="addEquipment[]" value="{{ $v }}">{{ $v }}</label></li>
                            @endforeach
                        </ul>
                    </span>
                </li>
                <hr/>
                <li><label>Apsauga</label>
                    <span class="block">
                        <ul>
                            @foreach ($security as $k => $v)
                                <li><label class="form-check-label"><input type="checkbox" name="security[]" value="{{ $v }}">{{ $v }}</label></li>
                            @endforeach
                        </ul>
                    </span>
                </li>
                <hr/>
                <li><label>Komentaras</label>
                    <span class="block komentarai">
                        <span>
                            <a href="javascript:void(0)" onclick="showComment('lt', this)"><img src="/modules/NTmodulis/images/lt.png" alt=""></a>
                            <a href="javascript:void(0)" onclick="showComment('en', this)"><img src="/modules/NTmodulis/images/en.png" alt=""></a>
                            <a href="javascript:void(0)" onclick="showComment('ru', this)"><img src="/modules/NTmodulis/images/ru.png" alt=""></a>
                        </span>
                        <span>
                            <textarea name="notes_lt" style="width: 80%" rows="5" class="note_lt comments"></textarea>
                        </span>
                    </span>
                </li>
                <hr/>
                <li><label>Nuotraukos</label>
                    <span class="block">
                        <input multiple="true" accept=".jpg,.gif,.png" name="photos[]" type="file">
                    </span>
                </li>
                <hr/>
                <li><label>Videonuoroda</label><input type="text" name="videoUrl" /> <label class="form-check-label"></li>
                <hr/>
                <li>
                    <label>Pastabos apie savininką<br/>(Nematoma)</label>
                    <span class="block">
                        <textarea name="ownerComment" style="width: 80%" rows="5" style="display:block"></textarea>
                    </span>
                </li>
                <hr/>
                <li class="actionOne">
                    <label>Kaina</label>
                    <input type="text" name="price" id="price" value="" size="50" maxlength="255"> €
                </li>
                {{-- <li class="actionTwo"><label>Kaina (mėn)</label>{$priceDis} €</li> --}}
                <li class="actionOne">
                    <label>Domina keitimas</label>
                    <span class="block">
                        <input type="checkbox" name="swap" />
                    </span></li>
                <hr/>
                <li><input value="Išsaugoti" name="submit" type="submit"></li>
            </ul></form>
        </div>
    </div>
</div>
</div>





@stop

{{-- Push extra CSS --}}

@push('css')
<style>

.alert-dismissible {
width: fit-content;
}
label.show {
margin-left: 10px;
}
.block ul {
display: flex;
flex-wrap: wrap;
}
.block ul li {
width: 20%;
margin-bottom: 1%;
white-space: nowrap;
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
width: 150px;
}

select, input[type="text"]{
min-width: 200px
}



</style>
@endpush

{{-- Push extra scripts --}}

@push('js')
<script>

$(function(){
  $('#photo_container').sortable({
      update: function( event, ui ) {
          updateImages()
      }
  })
})

function updateImages(){
  let photos = []
          $('#photo_container li img').each(function(){
              photos.push($(this).data('path'))
          })

          const id = {{ $data->idd }};

          $.ajax({
              url:`/admin/updateOrder`,
              type:"POST",
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data:{ photos, id },
              success: function(data){
                  console.log(data);
              }
          })
}


$('.delete_image').click(function(){
  if(confirm('Ar tikrai trinti?')){
      $(this).closest('li').remove()
      updateImages()
  }
})


$('select[name="region"]').change(function(){
  const id = $(this).val()
  $.get(`/admin/getRegion?region=${id}`,{},function(data){
      if(data){
         $('select[name="city"]').html(data)
      }
  })
})

$('select[name="city"]').change(function(){
  const id = $(this).val()
  $.get(`/admin/getMikroregion?miestas=${id}`,{},function(data){
      if(data){
         $('select[name="quarter"]').html(data)

         $.get(`/admin/getGatve?miestas=${id}`,{},function(data){
              if(data){
              $('select[name="streets"]').html(data)
              }
          })

      }
  })
})




</script>
@endpush
