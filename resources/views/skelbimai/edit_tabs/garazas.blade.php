@php

        $garazas = [
            1=> 'Mūrinis',
                'Geležinis',
                'Požeminis',
                'Daugiaaukštis',
                'Kita',
        ];

        $features = [
            1 => 'Apsauga',
                 'Automatiniai vartai',
                 'Duobė',
                 'Rūsys',
                 'Šildymas',
                 'Vanduo',
                 'Elektra',
        ];

@endphp
@extends('skelbimai.redagavimas')
@section('tab')
<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
<li class="nav-item">
    <a class="nav-link active" id="custom-content-below-garazas-tab" data-toggle="pill" href="#custom-content-below-garazas" role="tab" aria-controls="custom-content-below-garazas" aria-selected="true">Garažas</a>
  </li>
</ul>
<div class="tab-content" id="custom-content-below-tabContent">
<div class="tab-pane fade active show" id="custom-content-below-garazas" role="tabpanel" aria-labelledby="custom-content-below-garazas-tab">

    <div class="garazas tipas">
        <form method="post" enctype="multipart/form-data" action="">
            @csrf
            <input name="itemType" hidden="hidden" value="garazas"/>
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
                <hr/>
                <li><label>Plotas (m²)</label>
                    <input type="text" name="size" value="{{$data->size}}" />
                </li>
                <li><label>Garažo tipas</label>
                    <select name="garageType">
                        <option value="">Pasirinkite</option>
                        @foreach ($garazas as $v)
                            <option value="{{$v}}" @if($v == $data->garageType) selected @endif>{{$v}}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Telpa automobilių</label>
                    <input type="text" name="garageSize" value="{{$data->garageSize}}" />
                </li>
                <li><label>Metai</label>
                    <input type="text" name="years" value="{{$data->years}}" />
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
                <li><label>Videonuoroda</label><input type="text" name="videoUrl" value="{{$data->videoUrl}}" /> <label class="form-check-label"></li>
                <hr/>
                <li>
                    <label>Pastabos <br> savininką<br/>(Nematoma)</label>
                    <span class="block">
                        <textarea name="ownerComment" style="width: 80%" rows="5" style="display:block">{{$data->ownerComment}}</textarea>
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
