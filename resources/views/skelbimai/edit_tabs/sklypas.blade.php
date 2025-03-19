@php
    $purpose = [
    1 => 'Namų valda',
        'Daugiabučių statyba',
        'Žemės ūkio',
        'Sklypas soduose',
        'Miškų ūkio',
        'Pramonės',
        'Sandėliavimo',
        'Komercinė',
        'Rekreacinė',
        'Kita',
    ];


      $features = [
        1 =>'Elektra',
            'Dujos',
            'Vanduo',
            'Kraštinis sklypas',
            'Greta miško',
            'Be pastatų',
            'Geodeziniai matavimai',
            'Su pakrante',
            'Asfaltuotas privažiavimas',
        ];

@endphp

@extends('skelbimai.redagavimas')
@section('tab')
<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="custom-content-below-sklypas-tab" data-toggle="pill" href="#custom-content-below-sklypas" role="tab" aria-controls="custom-content-below-sklypas" aria-selected="true"><img src="{{asset('storage/svg/lot.svg') }}">Sklypas</a>
    </li>
  </ul>
  <div class="tab-content" id="custom-content-below-tabContent">
<div class="tab-pane fade active show" id="custom-content-below-sklypas" role="tabpanel" aria-labelledby="custom-content-below-sklypas-tab">

    <div class="butas tipas">
        <form method="post" enctype="multipart/form-data" action="">
            @csrf
            <input name="itemType" hidden="hidden" value="sklypas"/>
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
                <li><label>Sklypo numeris</label>
                    <input type="text" name="landSizeNr" value="{{$data->landSizeNr}}" /> <label class="form-check-label show"><input type="checkbox" name="showLandSizeNr" @if($data->showLandSizeNr ==1) checked @endif /> Rodyti</label>
                </li>
                <hr/>
                <li><label>Sklypo plotas (a)</label>
                    <input type="text" name="landSize" value="{{$data->landSize}}" />
                </li>
                <hr/>
                <li><label>Paskirtis</label>
                    <span class="block">
                        <ul>
                            @foreach ($purpose as $k => $v)
                                <li>
                                    <label class="form-check-label"><input type="checkbox" name="purpose[]" value="{{$v}}"
                                        @if (in_array($v, $purpose_values))
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
                                @endif>{{ $v }}</label></li>
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
                                <textarea style="width: 80%" rows="5" name="notes_lt" class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">{{ $data->notes_lt }}</textarea>
                                <textarea style="width: 80%" rows="5" name="notes_ru"  class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">{{ $data->notes_ru }}</textarea>
                            </div>
                        </div>
                    </span>
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
                <li><label>Videonuoroda</label><input type="text" name="videoUrl" value="{{$data->videoUrl}}"  /> <label class="form-check-label"></li>
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
