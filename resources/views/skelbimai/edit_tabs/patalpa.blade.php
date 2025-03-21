@php
       $purpose = [
             'Administracinė',
                'Prekybos',
                'Viešbučių',
                'Paslaugų',
                'Sandėliavimo',
                'Gamybos ir pramonės',
                'Maitinimo',
                'Kita',
            ];

        $features = [
            'Atskiras įėjimas',
                'Įėjimas iš gatvės',
                'Vitrininiai langai',
                'Vieta automobiliui',
                'Elektra',
                'Dujos',
                'Vanduo',
                'Asfaltuotas privažiavimas',
                'Internetas',
                'Telefono linija',
                'Galimybė keisti išplanavimą',
        ];

@endphp

@extends('skelbimai.redagavimas')
@section('tab')
<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="custom-content-below-sklypas-tab" data-toggle="pill" href="#custom-content-below-sklypas" role="tab" aria-controls="custom-content-below-sklypas" aria-selected="true"><img src="{{asset('storage/svg/premise.svg') }}">Patalpos</a>
    </li>
  </ul>
  <div class="tab-content" id="custom-content-below-tabContent">
<div class="tab-pane fade active show" id="custom-content-below-patalpa" role="tabpanel" aria-labelledby="custom-content-below-patalpa-tab">

    <div class="butas tipas">
        <form method="post" enctype="multipart/form-data" action="">
            @csrf
            <input name="itemType" hidden="hidden" value="patalpa"/>
            <ul>
                <li><label>Rodymas</label>
                    <select name="state">
                        <option value="active" @if($data->state == 'active') selected @endif>Rodomas</option>
                        <option value="inactive" @if($data->state == 'inactive') selected @endif>Nerodomas</option>
                    </select>
                </li>
                <li><label>Naujas</label>
                    <select name="newItem">
                        <option value="" >Pasirinkite</option>
                        <option value="1" @if($data->newItem == 1) selected @endif>Taip</option>
                        <option value="0" @if($data->newItem === 0) selected @endif>Ne</option>
                    </select>
                </li>
                <hr/>
                <li><label>Savivaldybė</label>
                    <select name="region">
                        <option value="">Pasirinkite</option>
                        @foreach ($savivaldybe as $k => $v)
                            <option value="{{$v->id}}" @if($v->id == $data->region) selected @endif>{{$v->vietove_name}}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Gyvenvietė</label>
                    <select name="city">
                        <option value="">Pasirinkite</option>
                        @foreach ($miestas as $k => $v)
                            <option value="{{$v->id}}" @if($v->id == $data->city) selected @endif>{{$v->miestas_name}}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Mikrorajonas</label>
                    <select name="quarter">
                        <option value="">Pasirinkite</option>
                        @foreach ($mikroregion as $k => $v)
                            <option value="{{$v->id}}" @if($v->id == $data->quarter) selected @endif>{{$v->kvartalas_name}}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Gatvė</label>
                    <select name="streets">
                        <option value="">Pasirinkite</option>
                        @foreach ($street as $k => $v)
                            <option value="{{$v->id}}" @if($v->id == $data->streets) selected @endif>{{$v->gatve_name}}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Namo numeris</label>
                    <input type="text" name="houseNr" value="{{ $data->houseNr }}" /> <label class="form-check-label show"><input type="checkbox" name="showHouseNr"  @if($data->showHouseNr ==1) checked @endif /> Rodyti</label>
                </li>
                <li><label>Buto numeris</label>
                    <input type="text" name="roomNr" value="{{ $data->roomNr }}" /> <label class="form-check-label show"><input type="checkbox" name="showRoomNr" @if($data->showRoomNr ==1) checked @endif  /> Rodyti</label>
                </li>
                <hr/>

                <li><label>Daugiau patalpų<br>šiame pastate</label>
                    <input type="checkbox" name="morePremises" @if($data->sizeFrom > 0) checked @endif />
                </li>
                <li><label>Sklypo plotas (a)</label>
                    <input type="text" name="sizeFull" value="{{$data->sizeFull}}" />
                </li>

                <li class="noMorePremises" @if($data->sizeFrom > 0) style="display: none" @endif><label>Bendras plotas (m²)</label>
                    <input type="text" name="size" value="{{$data->size}}" />
                </li>

                <li class="noMorePremises" @if($data->sizeFrom > 0) style="display: none" @endif><label>Aukštas</label>
                    <select name="floor">
                        <option value="">Pasirinkite</option>
                        @foreach (range(1, 100) as $v)
                        <option value="{{$v}}">{{$v}}</option>
                        @endforeach
                    </select>
                </li>
                <li class="morePremises" @unless($data->sizeFrom > 0) style="display: none" @endunless><label>Bendras plotas (m²)</label>
                    <span class="block">Nuo <input type="text" name="sizeFrom" value="{{$data->sizeFrom}}"> m² – Iki <input type="text" name="sizeTo" value="{{$data->sizeTo}}"> m²</span>
                </li>
                <li class="morePremises" @unless($data->sizeFrom > 0) style="display: none" @endunless>
                    <label>Aukštas</label>
                    <span class="block">Nuo
                        <select name="floorFrom">
                            <option value="">Pasirinkite</option>
                            @foreach (range(1, 100) as $v)
                            <option value="{{$v}}" @if($v == $data->floorFrom) selected @endif>{{$v}}</option>
                            @endforeach
                        </select> m² – Iki
                        <select name="floorTo">
                            <option value="">Pasirinkite</option>
                            @foreach (range(1, 100) as $v)
                            <option value="{{$v}}" @if($v == $data->floorTo) selected @endif>{{$v}}</option>
                            @endforeach
                        </select> m²
                    </span>
                </li>
                <li><label>Įrengimas</label>
                    <select name="equipment">
                        <option value="">Pasirinkite</option>
                        @foreach ($equipment as $k => $v)
                            <option value="{{$k}}" @if($k == $data->equipment) selected @endif>{{$v}}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Paskirtis</label>
                    <span class="block">
                        <ul>
                            @foreach ($purpose as $k => $v)
                                <li>
                                    <label class="form-check-label"><input type="checkbox" name="purpose[]" value="{{$k}}"
                                        @if (in_array($k, $purpose_values))
                                          checked
                                      @endif>{{ $v }}
                                </label></li>
                            @endforeach
                        </ul>
                    </span>
                </li>
                <li class="noMorePremises" @if($data->sizeFrom > 0) style="display: none" @endif><label>Patalpų skaičius</label>
                    <select name="premisesAmount">
                        <option value="">Pasirinkite</option>
                        @foreach (range(1, 100) as $v)
                            <option value="{{$v}}">{{$v}}</option>
                        @endforeach
                    </select>
                </li>
                <li class="morePremises" @unless($data->sizeFrom > 0) style="display: none" @endunless>
                    <label>Patalpų skaičius</label>
                    <span class="block">Nuo
                        <select name="premisesAmountFrom">
                            <option value="">Pasirinkite</option>
                            @foreach (range(1, 100) as $v)
                                <option value="{{$v}}" @if($v == $data->premisesAmountFrom) selected @endif>{{$v}}</option>
                            @endforeach
                        </select> – Iki
                        <select name="premisesAmountTo">
                            <option value="">Pasirinkite</option>
                            @foreach (range(1, 100) as $v)
                                <option value="{{$v}}" @if($v == $data->premisesAmountTo) selected @endif>{{$v}}</option>
                            @endforeach
                        </select>
                    </span>
                </li>
                <li><label>Aukštų sk.</label>
                    <select name="floorNr">
                        <option value="">Pasirinkite</option>
                        @foreach (range(1, 100) as $v)
                            <option value="{{$v}}" @if($v == $data->floorNr) selected @endif>{{$v}}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Metai</label>
                    <input type="text" name="years" value="{{$data->years}}" />
                </li>
                <hr/>
                <li><label>Vanduo</label>
                    <span class="block">
                        <ul>
                            @foreach ($water as $k => $v)
                                <li>
                                    <label class="form-check-label"><input type="checkbox" name="water[]" value="{{$k}}"
                                        @if (in_array($k, $water_values))
                                          checked
                                      @endif>{{ $v }}
                                </label></li>
                            @endforeach
                        </ul>
                    </span>
                </li>
                <hr/>
                <li><label>Šildymas</label>
                    <span class="block">
                        <ul>
                            @foreach ($heating as $k => $v)
                                <li>
                                    <label class="form-check-label"><input type="checkbox" name="heating[]" value="{{$k}}"
                                        @if (in_array($k, $heating_values))
                                          checked
                                      @endif>{{ $v }}
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
                                <li><label class="form-check-label"><input type="checkbox" name="addOptions[]" value="{{ $k }}"
                                    @if (in_array($k, $features_values))
                                          checked
                                      @endif>{{ $v }}</label></li>
                            @endforeach
                        </ul>
                    </span>
                </li>
                <hr/>
                <li><label>Papildomos patalpos</label>
                    <span class="block">
                        <ul>
                            @foreach ($additional_premises as $k => $v)
                                <li><label class="form-check-label"><input type="checkbox" name="addRooms[]" value="{{ $k }}"
                                    @if (in_array($k, $additional_premises_values))
                                          checked
                                      @endif>{{ $v }}</label></li>
                            @endforeach
                        </ul>
                    </span>
                </li>
                <hr/>
                <li><label>Papildoma įranga</label>
                    <span class="block">
                        <ul>
                            @foreach ($additional_equipment as $k => $v)
                                <li><label class="form-check-label"><input type="checkbox" name="addEquipment[]" value="{{ $k }}"
                                    @if (in_array($k, $additional_equipment_values))
                                          checked
                                      @endif>{{ $v }}</label></li>
                            @endforeach
                        </ul>
                    </span>
                </li>
                <hr/>
                <li><label>Apsauga</label>
                    <span class="block">
                        <ul>
                            @foreach ($security as $k => $v)
                                <li><label class="form-check-label"><input type="checkbox" name="security[]" value="{{ $k }}"
                                    @if (in_array($k, $security_values))
                                          checked
                                      @endif>{{ $v }}</label></li>
                            @endforeach
                        </ul>
                    </span>
                </li>
                <hr/>
                <li><label>Komentaras</label>
                    @include('MyComponents.comments', [$data->notes_lt, $data->notes_ru])
                </li>
                <hr/>
                <li><label>Nuotraukos</label>
                    <span class="block">
                        <input multiple="true" accept=".jpg,.gif,.png" name="photos[]" type="file">
                    </span>
                    <div style="margin: 20px 0 0 120px">
                        @if($photos)
                            <ul style="display: flex; flex-wrap: wrap;" id="photo_container">
                                @foreach ($photos as $v)
                                   <li style="position: relative"><img src="{{asset('storage/skelbimai/' . $v) }}" style="max-height: 150px; padding: 2px" data-path="{{ $v }}"/>
                                    <span class="delete_image" style="position: absolute; color: #c10000; right: 5%; top: 0; cursor: pointer; font-size: 21px"><b>&times;</b></span>
                                </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </li>
                <hr/>
                <li><label>Videonuoroda</label><input type="text" name="videoUrl" value="{{$data->videoUrl}}" /> <label class="form-check-label"></li>
                    <hr/>
                    <li>
                        <label>Pastabos apie<br>savininką<br/>(Nematoma)</label>
                        <span class="block">
                            <textarea name="ownerComment" style="width: 80%" rows="5" style="display:block">{{ $data->ownerComment }}</textarea>
                        </span>
                    </li>
                    <hr/>
                    <li class="actionOne">
                        <label>Kaina</label>
                        <input type="text" name="price" id="price" value="{{ $data->price }}" size="50" maxlength="255"> €
                    </li>
                    {{-- <li class="actionTwo"><label>Kaina (mėn)</label>{$priceDis} €</li> --}}
                    <br>
                    <li class="actionOne">
                        <label>Domina keitimas</label>
                        <span class="block">
                            <input type="checkbox" name="swap" @if($data->swap == 1) checked @endif />
                        </span></li>
                    <hr/>
                    <li>@include('MyComponents.submit')</li>
                </ul></form>
        </div>
      </div>
    </div>
  @endsection



    @push('js')
    <script>
        $('input[name="morePremises"]').click(function(){

            if($(this).prop('checked') == true){
                $('.noMorePremises').hide()
                $('.morePremises').show()
            }else{
                $('.noMorePremises').show()
                $('.morePremises').hide()
                $('input[name="sizeFrom"]').val('')
                $('input[name="sizeTo"]').val('')
                $('select[name="floorFrom"] option').eq(0).prop('selected', 'true')
                $('select[name="floorTo"] option').eq(0).prop('selected', 'true')
                $('select[name="premisesAmountFrom"] option').eq(0).prop('selected', 'true')
                $('select[name="premisesAmountTo"] option').eq(0).prop('selected', 'true')
            }
        })

    </script>
    @endpush
