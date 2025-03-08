@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content_body')

<div class="card-body">
            <h4>Pasirinkite objekto tipa</h4>
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Butas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Namas, kotedžas</a>
              </li>
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade active show" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
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
                                    <span>
                                        <a href="javascript:void(0)" onclick="showComment('lt', this)"><img src="/modules/NTmodulis/images/lt.png" alt=""></a>
                                        <a href="javascript:void(0)" onclick="showComment('en', this)"><img src="/modules/NTmodulis/images/en.png" alt=""></a>
                                        <a href="javascript:void(0)" onclick="showComment('ru', this)"><img src="/modules/NTmodulis/images/ru.png" alt=""></a>
                                    </span>
                                    <span>
                                        <textarea name="notes_lt" cols="80" rows="15" class="note_lt comments"></textarea>
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
                                    <textarea name="ownerComment" cols="80" rows="15" style="display:block"></textarea>
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
                            <li><input value="Submit" name="submit" type="submit"></li>
                        </ul></form>
                </div>
              </div>
              <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">

                <div class="tab-pane fade active show" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                    <div class="butas tipas">
                        <form method="post" enctype="multipart/form-data" action="">
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
                                    <select name="miestas">
                                        <option value="">Pasirinkite</option>
                                    </select>
                                </li>
                                <li><label>Mikrorajonas</label>
                                    <select name="mikrorajonas">
                                        <option value="">Pasirinkite</option>
                                    </select>
                                </li>
                                <li><label>Gatvė</label>
                                    <select name="gatve">
                                        <option value="">Pasirinkite</option>
                                    </select>
                                </li>
                                <li><label>Namo numeris</label>
                                    <input type="text" name="houseNr" /> <label class="form-check-label show"><input type="checkbox" name="showHouseNr" /> Rodyti</label>
                                </li>
                                <li><label>Buto numeris</label>
                                    <input type="text" name="roomNr" /> <label class="form-check-label show"><input type="checkbox" name="showRoomNr" /> Rodyti</label>
                                </li>
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
                                <hr/>
                                <li><label>Šildymas</label>
                                    <span class="block">
                                        <ul>
                                            <li><label class="form-check-label"><input type="checkbox" name="heating[]" value="Centrinis">Centrinis</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="heating[]" value="Elektra">Elektra</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="heating[]" value="Skystu kuru">Skystu kuru</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="heating[]" value="Centrinis kolektorinis">Centrinis kolektorinis</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="heating[]" value="Geoterminis">Geoterminis</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="heating[]" value="Oroterminis">Oroterminis</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="heating[]" value="Dujinis">Dujinis</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="heating[]" value="Kietu kuru">Kietu kuru</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="heating[]" value="Kita">Kita</label></li>
                                        </ul>
                                    </span>
                                </li>
                                <hr/>
                                <li><label>Ypatybės</label>
                                    <span class="block">
                                        <ul>
                                            <li><label class="form-check-label"><input type="checkbox" name="addOptions[]" value="Atskiras įėjimas">Atskiras įėjimas</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addOptions[]" value="Aukštos lubos">Aukštos lubos</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addOptions[]" value="Butas palėpėje">Butas palėpėje</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addOptions[]" value="Butas per kelis aukštus">Butas per kelis aukštus</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addOptions[]" value="Tualetas ir vonia atskirai">Tualetas ir vonia atskirai</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addOptions[]" value="Nauja kanalizacija">Nauja kanalizacija</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addOptions[]" value="Nauja elektros instaliacija">Nauja elektros instaliacija</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addOptions[]" value="Uždaras kiemas">Uždaras kiemas</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addOptions[]" value="Renovuotas namas">Renovuotas namas</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addOptions[]" value="Virtuvė sujungta su kambariu" >Virtuvė sujungta su kambariu</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addOptions[]" value="Internetas" >Internetas</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addOptions[]" value="Kabelinė televizija" >Kabelinė televizija</label></li>
                                        </ul>
                                    </span>
                                </li>
                                <hr/>
                                <li><label>Papildomos patalpos</label>
                                    <span class="block">
                                        <ul>
                                            <li><label class="form-check-label"><input type="checkbox" name="addRooms[]" value="Sandėliukas">Sandėliukas</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addRooms[]" value="Balkonas">Balkonas</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addRooms[]" value="Terasa">Terasa</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addRooms[]" value="Rūsys">Rūsys</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addRooms[]" value="Garažas">Garažas</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addRooms[]" value="Pirtis">Pirtis</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addRooms[]" value="Yra palėpė">Yra palėpė</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addRooms[]" value="Drabužinė">Drabužinė</label></li>
                                        </ul>
                                    </span>
                                </li>
                                <hr/>
                                <li><label>Papildoma įranga</label>
                                    <span class="block">
                                        <ul>
                                            <li><label class="form-check-label"><input type="checkbox" name="addEquipment[]" value="Kondicionierius">Kondicionierius</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addEquipment[]" value="Skalbimo mašina">Skalbimo mašina</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addEquipment[]" value="Su baldais">Su baldais</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addEquipment[]" value="Šaldytuvas">Šaldytuvas</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addEquipment[]" value="Šildomos grindys">Šildomos grindys</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addEquipment[]" value="Virtuvės komplektas">Virtuvės komplektas</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addEquipment[]" value="Viryklė">Viryklė</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addEquipment[]" value="Židinys">Židinys</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addEquipment[]" value="Wavin vamzdžiai">Wavin vamzdžiai</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addEquipment[]" value="Indaplovė">Indaplovė</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addEquipment[]" value="Dušo kabina">Dušo kabina</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="addEquipment[]" value="Vonia">Vonia</label></li>
                                        </ul>
                                    </span>
                                </li>
                                <hr/>
                                <li><label>Apsauga</label>
                                    <span class="block">
                                        <ul>
                                            <li><label class="form-check-label"><input type="checkbox" name="security[]" value="Aptverta teritorija">Aptverta teritorija</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="security[]" value="Šarvuotos durys">Šarvuotos durys</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="security[]" value="Signalizacija">Signalizacija</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="security[]" value="Kodinė laiptinės spyna">Kodinė laiptinės spyna</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="security[]" value="Videokameros">Videokameros</label></li>
                                            <li><label class="form-check-label"><input type="checkbox" name="security[]" value="Budintis sargas">Budintis sargas</label></li>
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
                                            <textarea name="notes_lt" cols="80" rows="15" class="note_lt comments"></textarea>
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
                                        <textarea name="ownerComment" cols="80" rows="15" style="display:block"></textarea>
                                    </span>
                                </li>
                                <hr/>
                                <li class="actionOne">
                                    <label>Kaina</label>
                                    <input type="text" name="price" id="price" value="" size="50" maxlength="255"> €
                                </li>
                                <li class="actionTwo"><label>Kaina (mėn)</label>{$priceDis} €</li>
                                <li class="actionOne">
                                    <label>Domina keitimas</label>
                                    <span class="block">
                                        <input type="checkbox" name="swap" />
                                    </span></li>
                                <hr/>
                                <li><input value="Submit" name="submit" type="submit"></li>
                            </ul></form>
                    </div>
                  </div>

              </div>
            </div>
          </div>





@stop

{{-- Push extra CSS --}}

@push('css')
<style>

label.show {
    margin-left: 10px;
}
.block ul {
        display: flex;
        flex-wrap: wrap;
    }
    .block ul li {
        width: 20%;
        margin-bottom: 2%;
        white-space: nowrap;
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

    #custom-content-below-home{
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
