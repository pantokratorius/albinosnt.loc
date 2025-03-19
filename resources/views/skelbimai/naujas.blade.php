@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'NT Modulis')
@section('content_header_subtitle', 'Naujas objektas')

{{-- Content body: main page content --}}

@section('content_body')
@include('MyComponents.alert')
<div class="card-body">
            <h4>Pasirinkite objekto tipa</h4>
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab"  aria-selected="true"><img src="{{asset('storage/svg/apartment.svg') }}">Butas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false"><img src="{{asset('storage/svg/house.svg') }}">Namas, kotedžas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-sodyba-tab" data-toggle="pill" href="#custom-content-below-sodyba" role="tab" aria-controls="custom-content-below-sodyba" aria-selected="false"><img src="{{asset('storage/svg/treehouse.jpg') }}">Sodyba</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-sodas-tab" data-toggle="pill" href="#custom-content-below-sodas" role="tab" aria-controls="custom-content-below-sodas" aria-selected="false"><img src="{{asset('storage/svg/tree.png') }}">Sodas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-sklypas-tab" data-toggle="pill" href="#custom-content-below-sklypas" role="tab" aria-controls="custom-content-below-sklypas" aria-selected="false"><img src="{{asset('storage/svg/lot.svg') }}">Sklypas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-patalpa-tab" data-toggle="pill" href="#custom-content-below-patalpa" role="tab" aria-controls="custom-content-below-patalpa" aria-selected="false"><img src="{{asset('storage/svg/premise.svg') }}">Patalpos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-garazas-tab" data-toggle="pill" href="#custom-content-below-garazas" role="tab" aria-controls="custom-content-below-garazas" aria-selected="false"><img src="{{asset('storage/svg/garage.svg') }}">Garažas</a>
              </li>
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade active show" id="custom-content-below-home" role="tabpanel" >
                <div class="butas tipas">
                    <form method="post" enctype="multipart/form-data" action="">
                        @csrf
                        <input name="itemType" hidden="hidden" value="butas"/>
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
                            <li><label>Buto numeris</label>
                                <input type="text" name="roomNr" /> <label class="form-check-label show"><input type="checkbox" name="showRoomNr" /> Rodyti</label>
                            </li>
                            <hr/>
                            <li><label>Plotas (m²)</label>
                                <input type="text" name="size" />
                            </li>
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
                            <li><label>Metai</label>
                                <input type="text" name="years" />
                            </li>
                            <li><label>Pastato tipas</label>
                                <select name="buildType">
                                    <option value="">Pasirinkite</option>
                                    @foreach ($buildType as $k => $v)
                                        <option value="{{$v}}">{{$v}}</option>
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
                                    <div class="card-header p-0 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">LT</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">RU</a>
                                              </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-four-tabContent">
                                            <textarea style="width: 80%" rows="5" name="notes_lt" class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab"></textarea>
                                            <textarea style="width: 80%" rows="5" name="notes_ru"  class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab"></textarea>
                                        </div>
                                    </div>
                                </span>
                                {{-- <span class="block komentarai">
                                    <span>
                                        <a href="javascript:void(0)" onclick="showComment('lt', this)"><img src="/modules/NTmodulis/images/lt.png" alt=""></a>
                                        <a href="javascript:void(0)" onclick="showComment('en', this)"><img src="/modules/NTmodulis/images/en.png" alt=""></a>
                                        <a href="javascript:void(0)" onclick="showComment('ru', this)"><img src="/modules/NTmodulis/images/ru.png" alt=""></a>
                                    </span>
                                    <span>
                                        <textarea name="notes_lt" style="width: 80%" rows="5" class="note_lt comments"></textarea>
                                    </span>
                                </span> --}}
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
                                <label>Pastabos apie<br>savininką<br/>(Nematoma)</label>
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
                            <li>@include('MyComponents.submit')</li>
                        </ul></form>
                </div>
              </div>

              @include('skelbimai.tabs.namas')
              @include('skelbimai.tabs.sodyba')
              @include('skelbimai.tabs.sodas')
              @include('skelbimai.tabs.sklypas')
              @include('skelbimai.tabs.patalpa')
              @include('skelbimai.tabs.garazas')

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

.alert-dismissible {
    width: fit-content;
}

label.show {
    margin-left: 10px;
}

li:has(.block) {
    display: flex;
}

.block {
            display: inline-block;
            width: 90%;
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
    }
    .block ul li input[type=checkbox] {
        margin-right: 5px;
    }

    .tab-pane{
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



    @media(max-width: 1650px){

        .block ul {
            display: inline-block;
        }

    }


</style>
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script>

        $('select[name="region"]').change(function(){

            $('select[name="quarter"]').attr('disabled', false)
            $('select[name="streets"]').attr('disabled', false)
            $('select[name="quarter"] option:first-child').attr('selected', true)
            $('select[name="streets"] option:first-child').attr('selected', true)

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
                        } else {
                            $('select[name="streets"]').attr('disabled', true)
                            $('select[name="streets"] option:first-child').attr('selected', true)
                        }
                    })

                }else {
                    $('select[name="quarter"]').attr('disabled', true)
                    $('select[name="streets"]').attr('disabled', true)
                    $('select[name="quarter"] option:first-child').attr('selected', true)
                    $('select[name="streets"] option:first-child').attr('selected', true)
                }
            })
        })




    </script>
@endpush
