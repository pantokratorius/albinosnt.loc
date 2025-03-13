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


<div class="tab-pane fade" id="custom-content-below-sklypas" role="tabpanel" aria-labelledby="custom-content-below-sklypas-tab">

    <div class="butas tipas">
        <form method="post" enctype="multipart/form-data" action="">
            @csrf
            <input name="itemType" hidden="hidden" value="sklypas"/>
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
                <li><label>Sklypo numeris</label>
                    <input type="text" name="landSizeNr" /> <label class="form-check-label show"><input type="checkbox" name="showLandSizeNr" /> Rodyti</label>
                </li>
                <hr/>
                <li><label>Sklypo plotas (a)</label>
                    <input type="text" name="landSize" />
                </li>
                <hr/>
                <li><label>Paskirtis</label>
                    <span class="block">
                        <ul>
                            @foreach ($purpose as $k => $v)
                                <li>
                                    <label class="form-check-label"><input type="checkbox" name="purpose[]" value="{{$v}}">{{ $v }}
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