@php

        $garazas = [
             'Mūrinis',
                'Geležinis',
                'Požeminis',
                'Daugiaaukštis',
                'Kita',
        ];

        $features = [
             'Apsauga',
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
    <a class="nav-link active" id="custom-content-below-garazas-tab" data-toggle="pill" href="#custom-content-below-garazas" role="tab" aria-controls="custom-content-below-garazas" aria-selected="true"><img src="{{asset('storage/svg/garage.svg') }}">Garažas</a>
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
                        @foreach ($garazas as $k => $v)
                            <option value="{{$k}}" @if($k == $data->garageType) selected @endif>{{$v}}</option>
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
                                <li><label class="form-check-label"><input type="checkbox" name="addOptions[]" value="{{ $k }}"
                                    @if (in_array($k, $features_values))
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
