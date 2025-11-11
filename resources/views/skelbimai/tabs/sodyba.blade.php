@php

    $features = [
        1 => 'Kraštinis sklypas',
            'Greta miško',
            'Asfaltuotas privažiavimas',
            'Elektra',
            'Dujos',
            'Internetas',
            'Kabelinė televizija',
        ];


$additional_premises = [
    1 => 'Baseinas',
        'Balkonas',
        'Garažas',
        'Pirtis',
        'Drabužinė',
        'Rūsys',
        'Ūkiniai pastatai',
        'Terasa',
        'Automobilio pastogė',
];






@endphp

<div class="tab-pane fade" id="custom-content-below-sodyba" role="tabpanel" aria-labelledby="custom-content-below-sodyba-tab">

    <div class="butas tipas">
        <form method="post" enctype="multipart/form-data" action="">
            @csrf
            <input name="itemType" hidden="hidden" value="sodyba"/>
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
                <li><label>Namo numeris</label>
                    <input type="text" name="houseNr" value="{{ old('houseNr') }}" /> <label class="form-check-label show"><input type="checkbox" name="showHouseNr" {{ old('showHouseNr') ? 'checked' : '' }}  /> Rodyti</label>
                </li>
                <hr/>
                <li><label>Plotas (m²)</label>
                    <input type="text" name="size" value="{{ old('size') }}" />
                </li>
                <li><label>Sklypo plotas (a)</label>
                    <input type="text" name="landSize" value="{{ old('landSize') }}" />
                </li>
                <li><label>Metai</label>
                    <input type="text" name="years" value="{{ old('years') }}" />
                </li>
                <li><label>Pastato tipas</label>
                    <select name="buildType">
                        <option value="">Pasirinkite</option>
                        @foreach ($buildType as $k => $v)
                            <option value="{{$v}}" {{ old('buildType') == $v ? 'selected' : '' }}>{{$v}}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Įrengimas</label>
                    <select name="equipment">
                        <option value="">Pasirinkite</option>
                        @foreach ($equipment as $k => $v)
                            <option value="{{$v}}" {{ old('equipment') == $v ? 'selected' : '' }}>{{$v}}</option>
                        @endforeach
                    </select>
                </li>
                <hr>
                <li><label>Kambarių sk.</label>
                    <select name="roomAmount">
                        <option value="">Pasirinkite</option>
                        @foreach (range(1, 100) as $v)
                            <option value="{{$v}}" {{ old('roomAmount') == $v ? 'selected' : '' }}>{{$v}}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Aukštas</label>
                    <select name="floor">
                        <option value="">Pasirinkite</option>
                        @foreach (range(1, 100) as $v)
                            <option value="{{$v}}" {{ old('floor') == $v ? 'selected' : '' }}>{{$v}}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Aukštų sk.</label>
                    <select name="floorNr">
                        <option value="">Pasirinkite</option>
                        @foreach (range(1, 100) as $v)
                            <option value="{{$v}}" {{ old('floorNr') == $v ? 'selected' : '' }}>{{$v}}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Artimiausias vandens<br>telkinys</label>
                    <select name="waterSource">
                        <option value="">Pasirinkite</option>
                        @foreach ($reservoir as $k => $v)
                            <option value="{{$v}}" {{ old('waterSource') == $v ? 'selected' : '' }}>{{$v}}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Iki vandens telkinio (m)</label>
                    <input type="text" name="waterDistance" value="{{ old('waterDistance') }}" />
                </li>



                <hr/>
                <li><label>Šildymas</label>
                    <span class="block">
                        <ul>
                            @foreach ($heating as $k => $v)
                                <li>
                                    <label class="form-check-label"><input type="checkbox" name="heating[]" value="{{$v}}"
                                        @if (in_array($v,  old('heating', []) ))
                                            checked
                                        @endif
                                        >{{ $v }}
                                </label></li>
                            @endforeach
                        </ul>
                    </span>
                </li>
                <hr/>
                <li><label>Vanduo</label>
                    <span class="block">
                        <ul>
                            @foreach ($water as $k => $v)
                                <li>
                                    <label class="form-check-label"><input type="checkbox" name="water[]" value="{{$v}}"
                                        @if (in_array($v,  old('water', []) ))
                                            checked
                                        @endif
                                        >{{ $v }}
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
                                    @if (in_array($v,  old('addOptions', []) ))
                                            checked
                                        @endif
                                    >{{ $v }}</label></li>
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
                                    @if (in_array($v,  old('addRooms', []) ))
                                            checked
                                        @endif
                                    >{{ $v }}</label></li>
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
                                    @if (in_array($v,  old('addEquipment', []) ))
                                            checked
                                        @endif
                                    >{{ $v }}</label></li>
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
                                    @if (in_array($v,  old('security', []) ))
                                            checked
                                        @endif
                                    >{{ $v }}</label></li>
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
                        <textarea name="ownerComment" style="width: 80%" rows="5" style="display:block">{{ old('ownerComment') }}</textarea>
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
                    </span></li>
                <hr/>
                <li>@include('MyComponents.submit')</li>
            </ul></form>
        </div>
    </div>
