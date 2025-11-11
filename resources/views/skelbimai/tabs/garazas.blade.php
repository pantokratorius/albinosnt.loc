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

<div class="tab-pane fade" id="custom-content-below-garazas" role="tabpanel" aria-labelledby="custom-content-below-garazas-tab">

    <div class="butas tipas">
        <form method="post" enctype="multipart/form-data" action="">
            @csrf
            <input name="itemType" hidden="hidden" value="garazas"/>
            <ul>
                <li><label>Pasirinkite veiksmą</label>
                     <select name="sellAction">
                        <option value="" {{ old('sellAction') == '' ? 'selected' : '' }}>Pasirinkite</option>
                        <option value="1" {{ old('sellAction') == '1' ? 'selected' : '' }}>Pardavimui</option>
                        <option value="2" {{ old('sellAction') == '2' ? 'selected' : '' }}>Nuomai</option>
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
                    <input type="text" name="size" value="{{ old('size') }}" />
                </li>
                <li><label>Garažo tipas</label>
                    <select name="garageType">
                        <option value="">Pasirinkite</option>
                        @foreach ($garazas as $k => $v)
                            <option value="{{$v}}" {{ old('garageType') == $v ? 'selected' : '' }}>{{$v}}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Telpa automobilių</label>
                    <input type="text" name="garageSize" value="{{ old('garageSize') }}" />
                </li>
                <li><label>Metai</label>
                    <input type="text" name="years" value="{{ old('years') }}" />
                </li>
                <hr/>
                <li><label>Ypatybės</label>
                    <span class="block">
                        <ul>
                            @foreach ($features as $k => $v)
                                <li><label class="form-check-label">
                                    <input type="checkbox" name="addOptions[]" value="{{ $v }}"
                                    @if (in_array($v,  old('addOptions', []) ))
                                        checked
                                    @endif
                                    >{{ $v }}
                                </label></li>
                            @endforeach
                        </ul>
                    </span>
                </li>
                <hr/>
                <li><label>Komentaras</label>
                    @include('MyComponents.comments')
                </li>
                <hr/>
                <li><label>Nuotraukos</label>
                    <span class="block">
                        <input multiple="true" accept=".jpg,.gif,.png" name="photos[]" type="file">
                    </span>
                </li>
                <hr/>
                <li><label>Videonuoroda</label><input type="text" name="videoUrl" value="{{ old('videoUrl') }}" /> <label class="form-check-label"></li>
                <hr/>
                <li>
                    <label>Pastabos apie<br>savininką<br/>(Nematoma)</label>
                    <span class="block">
                        <textarea name="ownerComment" style="width: 80%" rows="5" style="display:block" >{{ old('ownerComment') }}</textarea>
                    </span>
                </li>
                <hr/>
                <li class="actionOne">
                    <label>Kaina</label>
                    <input type="text" name="price" id="price" value="{{ old('price', '') }}" size="50" maxlength="255"> €
                </li>
                {{-- <li class="actionTwo"><label>Kaina (mėn)</label>{$priceDis} €</li> --}}
                <br>
                <li class="actionOne">
                    <label>Domina keitimas</label>
                    <span class="block">
                        <input type="checkbox" name="swap" {{ old('swap') ? 'checked' : '' }} />
                    </span>
                </li>
                <hr/>
                <li>@include('MyComponents.submit')</li>
            </ul></form>
        </div>
      </div>
