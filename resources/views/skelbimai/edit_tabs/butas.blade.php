@extends('skelbimai.redagavimas')
@section('tab')
<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true"><img src="{{asset('storage/svg/apartment.svg') }}">Butas</a>
    </li>
  </ul>
  <div class="tab-content" id="custom-content-below-tabContent">
    <div class="tab-pane fade active show" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
      <div class="butas tipas">
          <form method="post" enctype="multipart/form-data" action="">
              @csrf
              <input name="itemType" hidden="hidden" value="butas"/>
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
                  <li><label>Plotas (m²)</label>
                      <input type="text" name="size" value="{{ $data->size }}"/>
                  </li>
                  <li><label>Kambarių sk.</label>
                      <select name="roomAmount">
                          <option value="">Pasirinkite</option>
                          @foreach (range(1, 100) as $v)
                              <option value="{{$v}}" @if ($v == $data->roomAmount) selected @endif>{{$v}}</option>
                          @endforeach
                      </select>
                  </li>
                  <li><label>Aukštas</label>
                      <select name="floor">
                          <option value="">Pasirinkite</option>
                          @foreach (range(1, 100) as $v)
                              <option value="{{$v}}" @if ($v == $data->floor) selected @endif>{{$v}}</option>
                          @endforeach
                      </select>
                  </li>
                  <li><label>Aukštų sk.</label>
                      <select name="floorNr">
                          <option value="">Pasirinkite</option>
                          @foreach (range(1, 100) as $v)
                              <option value="{{$v}}" @if ($v == $data->floorNr) selected @endif>{{$v}}</option>
                          @endforeach
                      </select>
                  </li>
                  <li><label>Metai</label>
                      <input type="text" name="years" value="{{ $data->years }}" />
                  </li>
                  <li><label>Pastato tipas</label>
                      <select name="buildType">
                          <option value="">Pasirinkite</option>
                          @foreach ($buildType as $k => $v)
                              <option value="{{$v}}" @if ($v == $data->buildType) selected @endif>{{$v}}</option>
                          @endforeach
                      </select>
                  </li>
                  <li><label>Įrengimas</label>
                      <select name="equipment">
                          <option value="">Pasirinkite</option>
                          @foreach ($equipment as $k => $v)
                              <option value="{{$v}}" @if ($v == $data->equipment) selected @endif>{{$v}}</option>
                          @endforeach
                      </select>
                  </li>
                  <hr/>
                  <li><label>Šildymas</label>
                      <span class="block">
                          <ul>
                              @foreach ($heating as $k => $v)
                                  <li>
                                      <label class="form-check-label"><input type="checkbox" name="heating[]" value="{{$v}}"
                                      @if (in_array($v, $heating_values))
                                          checked
                                      @endif >{{ $v }}
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
                                  <li><label class="form-check-label"><input type="checkbox" name="addOptions[]" value="{{ $v }}"
                                      @if (in_array($v, $features_values))
                                      checked
                                  @endif >{{ $v }}</label></li>
                              @endforeach
                          </ul>
                      </span>
                  </li>
                  <hr/>
                  <li><label>Papildomos patalpos</label>
                      <span class="block">
                          <ul>
                              @foreach ($additional_premises as $k => $v)
                                  <li><label class="form-check-label"><input type="checkbox" name="addRooms[]" value="{{ $v }}"
                                      @if (in_array($v, $additional_premises_values))
                                      checked
                                  @endif >{{ $v }}</label></li>
                              @endforeach
                          </ul>
                      </span>
                  </li>
                  <hr/>
                  <li><label>Papildoma įranga</label>
                      <span class="block">
                          <ul>
                              @foreach ($additional_equipment as $k => $v)
                                  <li><label class="form-check-label"><input type="checkbox" name="addEquipment[]" value="{{ $v }}"
                                      @if (in_array($v, $additional_equipment_values))
                                      checked
                                  @endif >{{ $v }}</label></li>
                              @endforeach
                          </ul>
                      </span>
                  </li>
                  <hr/>
                  <li><label>Apsauga</label>
                      <span class="block">
                          <ul>
                              @foreach ($security as $k => $v)
                                  <li><label class="form-check-label"><input type="checkbox" name="security[]" value="{{ $v }}"
                                      @if (in_array($v, $security_values))
                                      checked
                                  @endif >{{ $v }}</label></li>
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
                          <input multiple="true" name="photos[]" type="file">
                      </span>
                      <div style="margin: 20px 0 0 120px">
                          @if($photos)
                              <ul style="display: flex; flex-wrap: wrap;" id="photo_container">
                                  @foreach ($photos as $v)
                                     <li style="position: relative"><img src="{{asset('storage/skelbimai/' . $v) }}" style="max-height: 150px; padding: 2px" data-path="{{ $v }}"/>
                                      <span class="delete_image"><b>&times;</b></span>
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
