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

<div class="tab-pane fade" id="custom-content-below-garazas" role="tabpanel" aria-labelledby="custom-content-below-garazas-tab">

    <div class="butas tipas">
        <form method="post" enctype="multipart/form-data" action="">
            @csrf
            <input name="itemType" hidden="hidden" value="garazas"/>
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
                <hr/>
                <li><label>Plotas (m²)</label>
                    <input type="text" name="size" />
                </li>
                <li><label>Garažo tipas</label>
                    <select name="garageType">
                        <option value="">Pasirinkite</option>
                        @foreach ($garazas as $v)
                            <option value="{{$v}}">{{$v}}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Telpa automobilių</label>
                    <input type="text" name="garageSize" />
                </li>
                <li><label>Metai</label>
                    <input type="text" name="years" />
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
                    </span>
                </li>
                <hr/>
                <li>@include('MyComponents.submit')</li>
            </ul></form>
        </div>
      </div>
