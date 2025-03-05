@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content_body')


{$tabs_start}
{$start_general_tab}
{$availableTags}
<div id="addItem">
    <h3>Pasirinkite objekto tipa</h3>
    <ul >
        <li><br>Butas</li>
        <li><br>Namas, kotedžas</li>
        <li><br>Sodyba</li>
        <li><br>Sodas</li>
        <li><br>Sklypas</li>
        <li><br>Patalpos</li>
        <li><br>Garažas</li>
        {{-- <li onclick="showAddType('butas', this)"><img alt="" src="/modules/NTmodulis/images/apartment.svg"><br>Butas</li>
        <li onclick="showAddType('namas', this)"><img alt="" src="/modules/NTmodulis/images/house.svg"><br>Namas, kotedžas</li>
        <li onclick="showAddType('sodyba', this)"><img alt="" src="/modules/NTmodulis/images/treehouse.jpg"><br>Sodyba</li>
        <li onclick="showAddType('sodas', this)"><img alt="" src="/modules/NTmodulis/images/tree.png"><br>Sodas</li>
        <li onclick="showAddType('sklypas', this)"><img alt="" src="/modules/NTmodulis/images/lot.svg"><br>Sklypas</li>
        <li onclick="showAddType('patalpa', this)"><img alt="" src="/modules/NTmodulis/images/premise.svg"><br>Patalpos</li>
        <li onclick="showAddType('garazas', this)"><img alt="" src="/modules/NTmodulis/images/garage.svg"><br>Garažas</li> --}}
        <!--<li onclick="showAddType('nuoma', this)"><img alt="" src="/modules/NTmodulis/images/short_rent.svg"><br>Nuoma</li>-->
    </ul>
</div>
<hr/>
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
            <li><label>Mikrorajonas</label>{$quarter}</li>
            <li><label>Gatvė</label>{$streets}</li>
            <li><label>Namo numeris</label>{$houseNr}{$showHouseNr} Rodyti</li>
            <li><label>Buto numeris</label>{$roomNr}{$showRoomNr} Rodyti</li>
            <hr/>
            <li><label>Plotas (m²)</label>{$size}</li>
            <li><label>Kambarių sk.</label>{$roomAmount}</li>
            <li><label>Aukštas</label>{$floor}</li>
            <li><label>Aukštų sk.</label>{$floorNr}</li>
            <li><label>Metai</label>{$years}</li>
            <li><label>Pastato tipas</label>{$buildType}</li>
            <li><label>Įrengimas</label>{$equipment}</li>
            <hr/>
            <li><label>Šildymas</label><span class="block">{$heating}</span></li>
            <hr/>
            <li><label>Ypatybės</label><span class="block">{$addOptions}</span></li>
            <hr/>
            <li><label>Papildomos patalpos</label><span class="block">{$addRooms}</span></li>
            <hr/>
            <li><label>Papildoma įranga</label><span class="block">{$addEquipment}</span></li>
            <hr/>
            <li><label>Apsauga</label><span class="block">{$security}</span></li>
            <hr/>
            <li><label>Komentaras</label>
                <span class="block komentarai">
                    <span>
                        <a href="javascript:void(0)" onclick="showComment('lt', this)"><img src="/modules/NTmodulis/images/lt.png" alt=""></a>
                        <a href="javascript:void(0)" onclick="showComment('en', this)"><img src="/modules/NTmodulis/images/en.png" alt=""></a>
                        <a href="javascript:void(0)" onclick="showComment('ru', this)"><img src="/modules/NTmodulis/images/ru.png" alt=""></a>
                    </span>
                    <span>
                        {$notes_lt}
                        {$notes_en}
                        {$notes_ru}
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
            <li><label>Videonuoroda</label>{$videoUrl}</li>
            <hr/>
            <li><label>Pastabos apie savininką<br/>(Nematoma)</label><span class="block">{$ownerComment}</span></li>
            <hr/>
            <li class="actionOne"><label>Kaina</label>{$price} €</li>
            <li class="actionTwo"><label>Kaina (mėn)</label>{$priceDis} €</li>
            <li class="actionOne"><label>Domina keitimas</label><span class="block">{$swap}</span></li>
            <hr/>
            <li><input value="Submit" name="submit" type="submit">&nbsp;<input value="Cancel" name="cancel" type="submit"></li>
        </ul></form>
</div>
<div class="namas tipas">
    <form method="post" enctype="multipart/form-data" action="">
    <input name="itemType" hidden="hidden" value="namas"/><ul>
            <li><label>Pasirinkite veiksmą</label>{$sellAction}</li>
            <hr/>
            <li><label>Savivaldybė</label>{$region}</li>
            <li><label>Gyvenvietė</label>{$city}</li>
            <li><label>Mikrorajonas</label>{$quarter}</li>
            <li><label>Gatvė</label>{$streets}</li>
            <li><label>Namo numeris</label>{$houseNr}{$showHouseNr} Rodyti</li>
            <hr/>
            <li><label>Plotas (m²)</label>{$size}</li>
            <li><label>Sklypo plotas (a)</label>{$landSize}</li>
            <li><label>Metai</label>{$years}</li>
            <li><label>Tipas</label>{$sellType}</li>
            <li><label>Pastato tipas</label>{$buildType}</li>
            <li><label>Įrengimas</label>{$equipment}</li>
            <hr/>
            <li><label>Kambarių sk.</label>{$roomAmount}</li>
            <li><label>Aukštas</label>{$floor}</li>
            <li><label>Aukštų sk.</label>{$floorNr}</li>
            <li><label>Artimiausias vandens telkinys</label>{$waterSource}</li>
            <li><label>Iki vandens telkinio (m)</label>{$waterDistance}</li>
            <hr/>
            <li><label>Šildymas</label><span class="block">{$heating}</span></li>
            <hr/>
            <li><label>Vanduo</label><span class="block">{$water}</span></li>
            <hr/>
            <li><label>Ypatybės</label><span class="block">{$addOptionsNamas}</span></li>
            <hr/>
            <li><label>Papildomos patalpos</label><span class="block">{$addRoomsNamas}</span></li>
            <hr/>
            <li><label>Papildoma įranga</label><span class="block">{$addEquipment}</span></li>
            <hr/>
            <li><label>Apsauga</label><span class="block">{$security}</span></li>
            <hr/>
            <li><label>Komentaras</label>
                <span class="block komentarai">
                    <span>
                        <a href="javascript:void(0)" onclick="showComment('lt', this)"><img src="/modules/NTmodulis/images/lt.png" alt=""></a>
                        <a href="javascript:void(0)" onclick="showComment('en', this)"><img src="/modules/NTmodulis/images/en.png" alt=""></a>
                        <a href="javascript:void(0)" onclick="showComment('ru', this)"><img src="/modules/NTmodulis/images/ru.png" alt=""></a>
                    </span>
                    <span>
                        {$notes_lt}
                        {$notes_en}
                        {$notes_ru}
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
            <li><label>Videonuoroda</label>{$videoUrl}</li>
            <hr/>
            <li><label>Pastabos apie savininką<br/>(Nematoma)</label><span class="block">{$ownerComment}</span></li>
            <hr/>
            <li class="actionOne"><label>Kaina</label>{$price} €</li>
            <li class="actionTwo"><label>Kaina (mėn)</label>{$priceDis} €</li>
            <li class="actionOne"><label>Domina keitimas</label><span class="block">{$swap}</span></li>
            <hr/>
            <li><input value="Submit" name="submit" type="submit">&nbsp;<input value="Cancel" name="cancel" type="submit"></li>
        </ul></form>
</div><div class="sodyba tipas">
    <form method="post" enctype="multipart/form-data" action="">
    <input name="itemType" hidden="hidden" value="sodyba"/><ul>
            <li><label>Pasirinkite veiksmą</label>{$sellAction}</li>
            <hr/>
            <li><label>Savivaldybė</label>{$region}</li>
            <li><label>Gyvenvietė</label>{$city}</li>
            <li><label>Mikrorajonas</label>{$quarter}</li>
            <li><label>Gatvė</label>{$streets}</li>
            <li><label>Namo numeris</label>{$houseNr}{$showHouseNr} Rodyti</li>
            <hr/>
            <li><label>Plotas (m²)</label>{$size}</li>
            <li><label>Sklypo plotas (a)</label>{$landSize}</li>
            <li><label>Metai</label>{$years}</li>
            <li><label>Pastato tipas</label>{$buildType}</li>
            <li><label>Įrengimas</label>{$equipment}</li>
            <hr/>
            <li><label>Šildymas</label><span class="block">{$heating}</span></li>
            <li><label>Kambarių sk.</label>{$roomAmount}</li>
            <li><label>Aukštas</label>{$floor}</li>
            <li><label>Aukštų sk.</label>{$floorNr}</li>
            <li><label>Artimiausias vandens telkinys</label>{$waterSource}</li>
            <li><label>Iki vandens telkinio (m)</label>{$waterDistance}</li>
            <hr/>
            <li><label>Vanduo</label><span class="block">{$water}</span></li>
            <hr/>
            <li><label>Ypatybės</label><span class="block">{$addOptionsNamas}</span></li>
            <hr/>
            <li><label>Papildomos patalpos</label><span class="block">{$addRoomsNamas}</span></li>
            <hr/>
            <li><label>Papildoma įranga</label><span class="block">{$addEquipment}</span></li>
            <hr/>
            <li><label>Apsauga</label><span class="block">{$security}</span></li>
            <hr/>
            <li><label>Komentaras</label>
                <span class="block komentarai">
                    <span>
                        <a href="javascript:void(0)" onclick="showComment('lt', this)"><img src="/modules/NTmodulis/images/lt.png" alt=""></a>
                        <a href="javascript:void(0)" onclick="showComment('en', this)"><img src="/modules/NTmodulis/images/en.png" alt=""></a>
                        <a href="javascript:void(0)" onclick="showComment('ru', this)"><img src="/modules/NTmodulis/images/ru.png" alt=""></a>
                    </span>
                    <span>
                        {$notes_lt}
                        {$notes_en}
                        {$notes_ru}
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
            <li><label>Videonuoroda</label>{$videoUrl}</li>
            <hr/>
            <li><label>Pastabos apie savininką<br/>(Nematoma)</label><span class="block">{$ownerComment}</span></li>
            <hr/>
            <li class="actionOne"><label>Kaina</label>{$price} €</li>
            <li class="actionTwo"><label>Kaina (mėn)</label>{$priceDis} €</li>
            <li class="actionOne"><label>Domina keitimas</label><span class="block">{$swap}</span></li>
            <hr/>
            <li><input value="Submit" name="submit" type="submit">&nbsp;<input value="Cancel" name="cancel" type="submit"></li>
        </ul></form>
</div>
<div class="sodas tipas">
    <form method="post" enctype="multipart/form-data" action="">
    <input name="itemType" hidden="hidden" value="sodas"/><ul>
            <li><label>Pasirinkite veiksmą</label>{$sellAction}</li>
            <hr/>
            <li><label>Savivaldybė</label>{$region}</li>
            <li><label>Gyvenvietė</label>{$city}</li>
            <li><label>Mikrorajonas</label>{$quarter}</li>
            <li><label>Gatvė</label>{$streets}</li>
            <li><label>Namo numeris</label>{$houseNr}{$showHouseNr} Rodyti</li>
            <hr/>
            <li><label>Plotas (m²)</label>{$size}</li>
            <li><label>Sklypo plotas (a)</label>{$landSize}</li>
            <li><label>Bendrijos pavadinimas</label>{$community}</li>
            <li><label>Metai</label>{$years}</li>
            <li><label>Pastato tipas</label>{$buildType}</li>
            <li><label>Įrengimas</label>{$equipment}</li>
            <hr/>
            <li><label>Šildymas</label><span class="block">{$heating}</span></li>
            <li><label>Kambarių sk.</label>{$roomAmount}</li>
            <li><label>Aukštas</label>{$floor}</li>
            <li><label>Aukštų sk.</label>{$floorNr}</li>
            <li><label>Artimiausias vandens telkinys</label>{$waterSource}</li>
            <li><label>Iki vandens telkinio (m)</label>{$waterDistance}</li>
            <hr/>
            <li><label>Vanduo</label><span class="block">{$water}</span></li>
            <hr/>
            <li><label>Ypatybės</label><span class="block">{$addOptions}</span></li>
            <hr/>
            <li><label>Papildomos patalpos</label><span class="block">{$addRooms}</span></li>
            <hr/>
            <li><label>Papildoma įranga</label><span class="block">{$addEquipment}</span></li>
            <hr/>
            <li><label>Apsauga</label><span class="block">{$security}</span></li>
            <hr/>
            <li><label>Komentaras</label>
                <span class="block komentarai">
                    <span>
                        <a href="javascript:void(0)" onclick="showComment('lt', this)"><img src="/modules/NTmodulis/images/lt.png" alt=""></a>
                        <a href="javascript:void(0)" onclick="showComment('en', this)"><img src="/modules/NTmodulis/images/en.png" alt=""></a>
                        <a href="javascript:void(0)" onclick="showComment('ru', this)"><img src="/modules/NTmodulis/images/ru.png" alt=""></a>
                    </span>
                    <span>
                        {$notes_lt}
                        {$notes_en}
                        {$notes_ru}
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
            <li><label>Videonuoroda</label>{$videoUrl}</li>
            <hr/>
            <li><label>Pastabos apie savininką<br/>(Nematoma)</label><span class="block">{$ownerComment}</span></li>
            <hr/>
            <li class="actionOne"><label>Kaina</label>{$price} €</li>
            <li class="actionTwo"><label>Kaina (mėn)</label>{$priceDis} €</li>
            <li class="actionOne"><label>Domina keitimas</label><span class="block">{$swap}</span></li>
            <hr/>
            <li><input value="Submit" name="submit" type="submit">&nbsp;<input value="Cancel" name="cancel" type="submit"></li>
        </ul></form>
</div>
<div class="sklypas tipas">
    <form method="post" enctype="multipart/form-data" action="">
    <input name="itemType" hidden="hidden" value="sklypas"/><ul>
            <li><label>Pasirinkite veiksmą</label>{$sellAction}</li>
            <hr/>
            <li><label>Savivaldybė</label>{$region}</li>
            <li><label>Gyvenvietė</label>{$city}</li>
            <li><label>Mikrorajonas</label>{$quarter}</li>
            <li><label>Gatvė</label>{$streets}</li>
            <li><label>Sklypo numeris</label>{$landSizeNr}{$showLandSizeNr} Rodyti</li>
            <hr/>
            <li><label>Sklypo plotas (a)</label>{$landSize}</li>
            <hr/>
            <li><label>Paskirtis</label><span class="block">{$purpose}</span></li>
            <hr/>
            <li><label>Ypatybės</label><span class="block">{$addOptionsSklypas}</span></li>
            <hr/>
            <li><label>Komentaras</label>
                <span class="block komentarai">
                    <span>
                        <a href="javascript:void(0)" onclick="showComment('lt', this)"><img src="/modules/NTmodulis/images/lt.png" alt=""></a>
                        <a href="javascript:void(0)" onclick="showComment('en', this)"><img src="/modules/NTmodulis/images/en.png" alt=""></a>
                        <a href="javascript:void(0)" onclick="showComment('ru', this)"><img src="/modules/NTmodulis/images/ru.png" alt=""></a>
                    </span>
                    <span>
                        {$notes_lt}
                        {$notes_en}
                        {$notes_ru}
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
            <li><label>Videonuoroda</label>{$videoUrl}</li>
            <hr/>
            <li><label>Pastabos apie savininką<br/>(Nematoma)</label><span class="block">{$ownerComment}</span></li>
            <hr/>
            <li class="actionOne"><label>Kaina</label>{$price} €</li>
            <li class="actionTwo"><label>Kaina (mėn)</label>{$priceDis} €</li>
            <li class="actionOne"><label>Domina keitimas</label><span class="block">{$swap}</span></li>
            <hr/>
            <li><input value="Submit" name="submit" type="submit">&nbsp;<input value="Cancel" name="cancel" type="submit"></li>
        </ul></form>
</div>
<div class="patalpa tipas">
    <form method="post" enctype="multipart/form-data" action="">
    <input name="itemType" hidden="hidden" value="patalpa"/><ul>
            <li><label>Pasirinkite veiksmą</label>{$sellAction}</li>
            <hr/>
            <li><label>Savivaldybė</label>{$region}</li>
            <li><label>Gyvenvietė</label>{$city}</li>
            <li><label>Mikrorajonas</label>{$quarter}</li>
            <li><label>Gatvė</label>{$streets}</li>
            <li><label>Namo numeris</label>{$houseNr}{$showHouseNr} Rodyti</li>
            <li><label>Patalpų numeris</label>{$premisesNr}{$showPremisesNr} Rodyti</li>
            <hr/>
            <li><label>Daugiau patalpų šiame pastate</label>{$morePremises}</li>
            <li><label>Sklypo plotas (a)</label>{$landSize}</li>
            <li class="morePremises" style="display: none"><label>Bendras plotas (m²)</label><span class="block">Nuo {$sizeFrom} m² – Iki {$sizeTo} m²</span></li>
            <li class="morePremises" style="display: none"><label>Aukštas</label><span class="block">Nuo {$floorFrom} – Iki {$floorTo}</span></li>
            <li class="noMorePremises"><label>Bendras plotas (m²)</label><span class="block"> {$sizeFull} m²</span></li>
            <li class="noMorePremises"><label>Aukštas</label><span class="block">{$floor}</span></li>
            <li><label>Įrengimas</label>{$equipment}</li>
            <hr/>
            <li><label>Paskirtis</label><span class="block">{$purposePatalpos}</span></li>
            <li class="morePremises" style="display: none"><label>Patalpų skaičius</label><span class="block">Nuo {$premisesAmountFrom} – Iki {$premisesAmountTo}</span></li>
            <li class="noMorePremises"><label>Patalpų skaičius</label><span class="block">{$premisesAmount}</span></li>
            <li><label>Aukštų sk.</label>{$floorNr}</li>
            <li><label>Metai</label>{$years}</li>
            <hr/>
            <li><label>Vanduo</label><span class="block">{$water}</span></li>
            <hr/>
            <li><label>Šildymas</label><span class="block">{$heating}</span></li>
            <hr/>
            <li><label>Ypatybės</label><span class="block">{$addOptionsPatalp}</span></li>
            <hr/>
            <li><label>Papildoma įranga</label><span class="block">{$addEquipment}</span></li>
            <hr/>
            <li><label>Apsauga</label><span class="block">{$security}</span></li>
            <hr/>
            <li><label>Komentaras</label>
                <span class="block komentarai">
                    <span>
                        <a href="javascript:void(0)" onclick="showComment('lt', this)"><img src="/modules/NTmodulis/images/lt.png" alt=""></a>
                        <a href="javascript:void(0)" onclick="showComment('en', this)"><img src="/modules/NTmodulis/images/en.png" alt=""></a>
                        <a href="javascript:void(0)" onclick="showComment('ru', this)"><img src="/modules/NTmodulis/images/ru.png" alt=""></a>
                    </span>
                    <span>
                        {$notes_lt}
                        {$notes_en}
                        {$notes_ru}
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
            <li><label>Videonuoroda</label>{$videoUrl}</li>
            <hr/>
            <li><label>Pastabos apie savininką<br/>(Nematoma)</label><span class="block">{$ownerComment}</span></li>
            <hr/>
            <li class="actionOne"><label>Kaina</label><span class="block">{$price}€</span></li>
            <li class="actionTwo"><label>Kaina (mėn)</label><span class="block">Nuo {$priceFromDis} – Iki {$priceToDis}€</span></li>
            <li class="actionOne"><label>Domina keitimas</label><span class="block">{$swap}</span></li>
            <hr/>
            <li><input value="Submit" name="submit" type="submit">&nbsp;<input value="Cancel" name="cancel" type="submit"></li>
        </ul></form>
</div>
<div class="garazas tipas">
    <form method="post" enctype="multipart/form-data" action="">
    <input name="itemType" hidden="hidden" value="garazas"/><ul>
            <li><label>Pasirinkite veiksmą</label>{$sellAction}</li>
            <hr/>
            <li><label>Savivaldybė</label>{$region}</li>
            <li><label>Gyvenvietė</label>{$city}</li>
            <li><label>Mikrorajonas</label>{$quarter}</li>
            <li><label>Gatvė</label>{$streets}</li>
            <hr/>
            <li><label>Plotas (m²)</label>{$size}</li>
            <li><label>Garažo tipas</label>{$garageType}</li>
            <li><label>Telpa automobilių</label>{$garageSize}</li>
            <li><label>Metai</label>{$years}</li>
            <hr/>
            <li><label>Ypatybės</label><span class="block">{$addOptionsGaraz}</span></li>
            <hr/>
            <li><label>Komentaras</label>
                <span class="block komentarai">
                    <span>
                        <a href="javascript:void(0)" onclick="showComment('lt', this)"><img src="/modules/NTmodulis/images/lt.png" alt=""></a>
                        <a href="javascript:void(0)" onclick="showComment('en', this)"><img src="/modules/NTmodulis/images/en.png" alt=""></a>
                        <a href="javascript:void(0)" onclick="showComment('ru', this)"><img src="/modules/NTmodulis/images/ru.png" alt=""></a>
                    </span>
                    <span>
                        {$notes_lt}
                        {$notes_en}
                        {$notes_ru}
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
            <li><label>Videonuoroda</label>{$videoUrl}</li>
            <hr/>
            <li><label>Pastabos apie savininką<br/>(Nematoma)</label><span class="block">{$ownerComment}</span></li>
            <hr/>
            <li class="actionOne"><label>Kaina</label>{$price} €</li>
            <li class="actionTwo"><label>Kaina (mėn)</label>{$priceDis} €</li>
            <li class="actionOne"><label>Domina keitimas</label><span class="block">{$swap}</span></li>
            <hr/>
            <li><input value="Submit" name="submit" type="submit">&nbsp;<input value="Cancel" name="cancel" type="submit"></li>
        </ul></form>
</div>
<div class="nuoma tipas">
    <form method="post" enctype="multipart/form-data" action="">
    <input name="itemType" hidden="hidden" value="nuoma"/>
    <input name="sellAction" hidden="hidden" value="2"/>
    <ul>
            <li><label>Savivaldybė</label>{$region}</li>
            <li><label>Gyvenvietė</label>{$city}</li>
            <li><label>Mikrorajonas</label>{$quarter}</li>
            <li><label>Gatvė</label>{$streets}</li>
            <li><label>Namo numeris</label>{$houseNr}{$showHouseNr} Rodyti</li>
            <hr/>
            <li><label>Bendras plotas (m²)</label>{$sizeFull}</li>
            <li><label>Tipas</label>{$sellTypeGaraz}</li>
            <li><label>Kambarių sk.</label>{$roomAmount}</li>
            <li><label>Aukštas</label>{$floor}</li>
            <li><label>Aukštų sk.</label>{$floorNr}</li>
            <li><label>Miegamosios vietos</label>{$sleepPlace}</li>
            <hr/>
            <li><label>Ypatybės</label><span class="block">{$addOptionsNuoma}</span></li>
            <hr/>
            <li><label>Komentaras</label>
                <span class="block komentarai">
                    <span>
                        <a href="javascript:void(0)" onclick="showComment('lt', this)"><img src="/modules/NTmodulis/images/lt.png" alt=""></a>
                        <a href="javascript:void(0)" onclick="showComment('en', this)"><img src="/modules/NTmodulis/images/en.png" alt=""></a>
                        <a href="javascript:void(0)" onclick="showComment('ru', this)"><img src="/modules/NTmodulis/images/ru.png" alt=""></a>
                    </span>
                    <span>
                        {$notes_lt}
                        {$notes_en}
                        {$notes_ru}
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
            <li><label>Videonuoroda</label>{$videoUrl}</li>
            <hr/>
            <li><label>Pastabos apie savininką<br/>(Nematoma)</label><span class="block">{$ownerComment}</span></li>
            <hr/>
            <li class="actionOne"><label>Kaina</label>{$price} €</li>
            <hr/>
            <li><input value="Submit" name="submit" type="submit">&nbsp;<input value="Cancel" name="cancel" type="submit"></li>
        </ul></form>
</div>
{$tab_end}
{if $start_add_tab != ''}
    {$start_add_tab}
        <div >
            Greita paieška: <input type="text" style="height: 16px;" placeholder="Skelbimo ID" name="skelbid" id="skelbid"/><input style="margin: 0; top: -1px" type="button" onclick="goToSkelb()" value="Ieškoti"/>
            &nbsp;&nbsp;&nbsp;&nbsp;<form method="post" >
            Filtravimas: <select name="category" class="" id="cat">
                <option value="">Kategorija</option>
                <option value="butas">Butas</option>
                <option value="namas">Namas, kotedžas</option>
                <option value="sodyba">Sodyba</option>
                <option value="sodas">Sodas</option>
                <option value="sklypas">Sklypas</option>
                <option value="patalpa">Patalpos</option>
                <option value="garazas">Garažas</option>
                <option value="nuoma">Nuoma</option>
            </select>
            {if $adminLogged==1}<select name="vadyb" class="" id="vadyb">
                <option value="">Vadybininkas</option>
                {$vadyb}
            </select>{/if}
            <input style="margin: 0; top: -1px" type="submit" name="filterList" value="Filtruoti"/>
            </form>
            <br/>
            <br/>
            <b>Iš viso skelbimų:</b> {$skelbimai|@count}
            <br/>
            <br/>
            <table class="skelbList" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                    <td width="500">
                        <b>Skelbimo ID</b>
                    </td>
                    <td width="200">
                        <b>Būsena</b>
                    </td>
                    <td width="200">
                        <b>Tipas</b>
                    </td>
                    <td width="200">
                        <b>Gatvė</b>
                    </td>
                    <td width="200">
                        <b>Miestas</b>
                    </td>
                    <td width="200">
                        <b>Aukštas</b>
                    </td>
                    <td width="200">
                        <b>Kambariai</b>
                    </td>
                    <td width="200">
                        <b>Kaina</b>
                    </td>
                    <td width="200">
                        <b>Vadybininkas</b>
                    </td>
                    <td width="100">
                        <b>Veiksmai</b>
                    </td>
                </tr>
            {foreach from=$skelbimai item=entry}
                <tr class="skelb{$entry.id}">
                    <td style="padding: 5px 0;">{$entry.id}</td>
                    <td style="padding: 5px 0;">{if $entry.state=='inactive'}Nerodomas{else}Rodomas{/if}</td>
                    <td style="padding: 5px 0;">{if $entry.sellType!=''}{$entry.sellType|ucfirst}{else}{$entry.itemType|ucfirst}{/if}</td>
                    <td style="padding: 5px 0;">{$entry.gatve_name}</td>
                    <td style="padding: 5px 0;">{$entry.miestas_name}</td>
                    <td style="padding: 5px 0;">
                    {if $entry.floor!=0 || $entry.floorNr!=0}
                            {if $entry.floor!=0}{$entry.floor}{/if}
                            {if $entry.floor!=0 && $entry.floorNr!=0} / {/if}
                            {if $entry.floorNr!=0}{$entry.floorNr}{/if} a.
                    {/if}</td>
                    <td style="padding: 5px 0;">{if $entry.roomAmount}{$entry.roomAmount} kamb.{/if}</td>
                    <td style="padding: 5px 0;">{$entry.price}</td>
                    <td style="padding: 5px 0;">{$entry.first_name} {$entry.last_name}</td>
                    <td style="padding: 5px 0; text-align: right;"><a href="/nekilnojamas-turtas/skelbimo-perziura.php?entryID={$entry.id}" target="_blank">Peržiūra</a>&nbsp;&nbsp;<a href="moduleinterface.php?_sx_={$sx}&module=NTmodulis&m1_active_tab=edit&editID={$entry.id}">Redaguoti</a>&nbsp;&nbsp;<a href="moduleinterface.php?_sx_={$sx}&module=NTmodulis&m1_active_tab=general&deleteID={$entry.id}" onclick="return confirm('Ar tikrai norite pašalinti?')">Ištrinti</a></td>
                </tr>
            {/foreach}
            </table>
        </div>
    {$tab_end}
{/if}
{if $start_edit_tab != ''}
    {$start_edit_tab}
        <div id="editBlock">
            {$availableTags}
            <script type="text/javascript">
                {literal}
                function rotateImg(imgPath, elem){
                    $.ajax({
                        type:"POST",
                        url:"/rotateImg.php",
                        data:{imgUrl:imgPath},
                        success:function(html){
                            //jQuery(this, elem).prev().prev().prev().prev().attr('src', html);
                            $(elem, this).parent().children('img').removeAttr('src');
                            d = new Date();
                            $(elem, this).parent().children('img').attr('src', html+"?"+d.getTime());
                        }
                    });
                };
                function rotateImgLeft(imgPath, elem){
                    $.ajax({
                        type:"POST",
                        url:"/rotateImgLeft.php",
                        data:{imgUrl:imgPath},
                        success:function(html){
                            //jQuery(this, elem).prev().prev().prev().prev().attr('src', html);
                            $(elem, this).parent().children('img').removeAttr('src');
                            d = new Date();
                            $(elem, this).parent().children('img').attr('src', html+"?"+d.getTime());
                        }
                    });
                };
                {/literal}
            </script>
            <div class="butas tipas" {if $entry_info.itemType=='butas'}style="display: block"{/if}>
                <form method="post" enctype="multipart/form-data" action="">
                <ul>
                        <li><label>Rodymas</label><select name="state" class="cms_dropdown"><option {if $entry_info.state=='active'}selected="selected"{/if} value="active">Rodomas</option><option {if $entry_info.state=='inactive'}selected="selected"{/if} value="inactive">Nerodomas</option></select></li>
                        <li><label>Naujas</label><select name="newItem" class="cms_dropdown"><option {if $entry_info.newItem=='1'}selected="selected"{/if} value="1">Taip</option><option {if $entry_info.newItem=='0'}selected="selected" value="0"{/if}>Ne</option></select></li>
                        <hr/>
                        <li><label>Savivaldybė</label>{$region}</li>
                        <li><label>Gyvenvietė</label>{$city}</li>
                        <li><label>Mikrorajonas</label>{$quarter}</li>
                        <li><label>Gatvė</label>{$streets}</li>
                        <li><label>Namo numeris</label>{$houseNr}{$showHouseNr} Rodyti</li>
                        <li><label>Buto numeris</label>{$roomNr}{$showRoomNr} Rodyti</li>
                        <hr/>
                        <li><label>Plotas (m²)</label>{$size}</li>
                        <li><label>Kambarių sk.</label>{$roomAmount}</li>
                        <li><label>Aukštas</label>{$floor}</li>
                        <li><label>Aukštų sk.</label>{$floorNr}</li>
                        <li><label>Metai</label>{$years}</li>
                        <li><label>Pastato tipas</label>{$buildType}</li>
                        <li><label>Įrengimas</label>{$equipment}</li>
                        <hr/>
                        <li><label>Šildymas</label><span class="block">{$heating}</span></li>
                        <hr/>
                        <li><label>Ypatybės</label><span class="block">{$addOptions}</span></li>
                        <hr/>
                        <li><label>Papildomos patalpos</label><span class="block">{$addRooms}</span></li>
                        <hr/>
                        <li><label>Papildoma įranga</label><span class="block">{$addEquipment}</span></li>
                        <hr/>
                        <li><label>Apsauga</label><span class="block">{$security}</span></li>
                        <hr/>
                        <li><label>Komentaras</label>
                            <span class="block komentarai">
                                <span>
                                    <a href="javascript:void(0)" onclick="showComment('lt', this)"><img src="/modules/NTmodulis/images/lt.png" alt=""></a>
                                    <a href="javascript:void(0)" onclick="showComment('en', this)"><img src="/modules/NTmodulis/images/en.png" alt=""></a>
                                    <a href="javascript:void(0)" onclick="showComment('ru', this)"><img src="/modules/NTmodulis/images/ru.png" alt=""></a>
                                </span>
                                <span>
                                    {$notes_lt}
                                    {$notes_en}
                                    {$notes_ru}
                                </span>
                            </span>
                        </li>
                        <hr/>
                        <li><label>Nuotraukos</label>
                            <span class="block">
                                {$imagesList}<input multiple="true" accept=".jpg,.gif,.png" name="photos[]" type="file">
                            </span>
                        </li>
                        <hr/>
                        <li><label>Videonuoroda</label>{$videoUrl}</li>
                        <hr/>
                        <li><label>Pastabos apie savininką<br/>(Nematoma)</label><span class="block">{$ownerComment}</span></li>
                        <hr/>
                        {if $entry_info.sellAction==1}<li><label>Kaina</label>{$price} €</li>{else}
                        <li><label>Kaina (mėn)</label>{$price} €</li>{/if}
                        {if $entry_info.sellAction==1}<li><label>Domina keitimas</label><span class="block">{$swap}</span></li>{/if}
                        <hr/>
                        <li><input value="Save" name="edit" type="submit">&nbsp;<input value="Cancel" name="cancel" type="submit"></li>
                    </ul></form>
            </div>
            <div class="namas tipas" {if $entry_info.itemType=='namas'}style="display: block"{/if}>
                <form method="post" enctype="multipart/form-data" action="">
                <ul>
                        <li><label>Rodymas</label><select name="state" class="cms_dropdown"><option {if $entry_info.state=='active'}selected="selected"{/if} value="active">Rodomas</option><option {if $entry_info.state=='inactive'}selected="selected"{/if} value="inactive">Nerodomas</option></select></li>
                        <li><label>Naujas</label><select name="newItem" class="cms_dropdown"><option {if $entry_info.newItem=='1'}selected="selected"{/if} value="1">Taip</option><option {if $entry_info.newItem=='0'}selected="selected" value="0"{/if}>Ne</option></select></li>
                        <hr/>
                        <li><label>Savivaldybė</label>{$region}</li>
                        <li><label>Gyvenvietė</label>{$city}</li>
                        <li><label>Mikrorajonas</label>{$quarter}</li>
                        <li><label>Gatvė</label>{$streets}</li>
                        <li><label>Namo numeris</label>{$houseNr}{$showHouseNr} Rodyti</li>
                        <hr/>
                        <li><label>Plotas (m²)</label>{$size}</li>
                        <li><label>Sklypo plotas (a)</label>{$landSize}</li>
                        <li><label>Metai</label>{$years}</li>
                        <li><label>Tipas</label>{$sellType}</li>
                        <li><label>Pastato tipas</label>{$buildType}</li>
                        <li><label>Įrengimas</label>{$equipment}</li>
                        <hr/>
                        <li><label>Kambarių sk.</label>{$roomAmount}</li>
                        <li><label>Aukštas</label>{$floor}</li>
                        <li><label>Aukštų sk.</label>{$floorNr}</li>
                        <li><label>Artimiausias vandens telkinys</label>{$waterSource}</li>
                        <li><label>Iki vandens telkinio (m)</label>{$waterDistance}</li>
                        <hr/>
                        <li><label>Šildymas</label><span class="block">{$heating}</span></li>
                        <hr/>
                        <li><label>Vanduo</label><span class="block">{$water}</span></li>
                        <hr/>
                        <li><label>Ypatybės</label><span class="block">{$addOptionsNamas}</span></li>
                        <hr/>
                        <li><label>Papildomos patalpos</label><span class="block">{$addRoomsNamas}</span></li>
                        <hr/>
                        <li><label>Papildoma įranga</label><span class="block">{$addEquipment}</span></li>
                        <hr/>
                        <li><label>Apsauga</label><span class="block">{$security}</span></li>
                        <hr/>
                        <li><label>Komentaras</label>
                            <span class="block komentarai">
                                <span>
                                    <a href="javascript:void(0)" onclick="showComment('lt', this)"><img src="/modules/NTmodulis/images/lt.png" alt=""></a>
                                    <a href="javascript:void(0)" onclick="showComment('en', this)"><img src="/modules/NTmodulis/images/en.png" alt=""></a>
                                    <a href="javascript:void(0)" onclick="showComment('ru', this)"><img src="/modules/NTmodulis/images/ru.png" alt=""></a>
                                </span>
                                <span>
                                    {$notes_lt}
                                    {$notes_en}
                                    {$notes_ru}
                                </span>
                            </span>
                        </li>
                        <hr/>
                        <li><label>Nuotraukos</label>
                            <span class="block">
                                {$imagesList}<input multiple="true" accept=".jpg,.gif,.png" name="photos[]" type="file">
                            </span>
                        </li>
                        <hr/>
                        <li><label>Videonuoroda</label>{$videoUrl}</li>
                        <hr/>
                        <li><label>Pastabos apie savininką<br/>(Nematoma)</label><span class="block">{$ownerComment}</span></li>
                        <hr/>
                        {if $entry_info.sellAction==1}<li><label>Kaina</label>{$price} €</li>{else}
                        <li><label>Kaina (mėn)</label>{$price} €</li>{/if}
                        {if $entry_info.sellAction==1}<li><label>Domina keitimas</label><span class="block">{$swap}</span></li>{/if}
                        <hr/>
                        <li><input value="Save" name="edit" type="submit">&nbsp;<input value="Cancel" name="cancel" type="submit"></li>
                    </ul></form>
            </div>
            <div class="sodyba tipas" {if $entry_info.itemType=='sodyba'}style="display: block"{/if}>
                <form method="post" enctype="multipart/form-data" action="">
                <ul>
                        <li><label>Rodymas</label><select name="state" class="cms_dropdown"><option {if $entry_info.state=='active'}selected="selected"{/if} value="active">Rodomas</option><option {if $entry_info.state=='inactive'}selected="selected"{/if} value="inactive">Nerodomas</option></select></li>
                        <li><label>Naujas</label><select name="newItem" class="cms_dropdown"><option {if $entry_info.newItem=='1'}selected="selected"{/if} value="1">Taip</option><option {if $entry_info.newItem=='0'}selected="selected" value="0"{/if}>Ne</option></select></li>
                        <hr/>
                        <li><label>Savivaldybė</label>{$region}</li>
                        <li><label>Gyvenvietė</label>{$city}</li>
                        <li><label>Mikrorajonas</label>{$quarter}</li>
                        <li><label>Gatvė</label>{$streets}</li>
                        <li><label>Namo numeris</label>{$houseNr}{$showHouseNr} Rodyti</li>
                        <hr/>
                        <li><label>Plotas (m²)</label>{$size}</li>
                        <li><label>Sklypo plotas (a)</label>{$landSize}</li>
                        <li><label>Metai</label>{$years}</li>
                        <li><label>Pastato tipas</label>{$buildType}</li>
                        <li><label>Įrengimas</label>{$equipment}</li>
                        <hr/>
                        <li><label>Šildymas</label><span class="block">{$heating}</span></li>
                        <li><label>Kambarių sk.</label>{$roomAmount}</li>
                        <li><label>Aukštas</label>{$floor}</li>
                        <li><label>Aukštų sk.</label>{$floorNr}</li>
                        <li><label>Artimiausias vandens telkinys</label>{$waterSource}</li>
                        <li><label>Iki vandens telkinio (m)</label>{$waterDistance}</li>
                        <hr/>
                        <li><label>Vanduo</label><span class="block">{$water}</span></li>
                        <hr/>
                        <li><label>Ypatybės</label><span class="block">{$addOptionsNamas}</span></li>
                        <hr/>
                        <li><label>Papildomos patalpos</label><span class="block">{$addRoomsNamas}</span></li>
                        <hr/>
                        <li><label>Papildoma įranga</label><span class="block">{$addEquipment}</span></li>
                        <hr/>
                        <li><label>Apsauga</label><span class="block">{$security}</span></li>
                        <hr/>
                        <li><label>Komentaras</label>
                            <span class="block komentarai">
                                <span>
                                    <a href="javascript:void(0)" onclick="showComment('lt', this)"><img src="/modules/NTmodulis/images/lt.png" alt=""></a>
                                    <a href="javascript:void(0)" onclick="showComment('en', this)"><img src="/modules/NTmodulis/images/en.png" alt=""></a>
                                    <a href="javascript:void(0)" onclick="showComment('ru', this)"><img src="/modules/NTmodulis/images/ru.png" alt=""></a>
                                </span>
                                <span>
                                    {$notes_lt}
                                    {$notes_en}
                                    {$notes_ru}
                                </span>
                            </span>
                        </li>
                        <hr/>
                        <li><label>Nuotraukos</label>
                            <span class="block">
                                {$imagesList}<input multiple="true" accept=".jpg,.gif,.png" name="photos[]" type="file">
                            </span>
                        </li>
                        <hr/>
                        <li><label>Videonuoroda</label>{$videoUrl}</li>
                        <hr/>
                        <li><label>Pastabos apie savininką<br/>(Nematoma)</label><span class="block">{$ownerComment}</span></li>
                        <hr/>
                        {if $entry_info.sellAction==1}<li><label>Kaina</label>{$price} €</li>{else}
                        <li><label>Kaina (mėn)</label>{$price} €</li>{/if}
                        {if $entry_info.sellAction==1}<li><label>Domina keitimas</label><span class="block">{$swap}</span></li>{/if}
                        <hr/>
                        <li><input value="Save" name="edit" type="submit">&nbsp;<input value="Cancel" name="cancel" type="submit"></li>
                    </ul></form>
            </div>
            <div class="sodas tipas" {if $entry_info.itemType=='sodas'}style="display: block"{/if}>
                <form method="post" enctype="multipart/form-data" action="">
                <ul>
                        <li><label>Rodymas</label><select name="state" class="cms_dropdown"><option {if $entry_info.state=='active'}selected="selected"{/if} value="active">Rodomas</option><option {if $entry_info.state=='inactive'}selected="selected"{/if} value="inactive">Nerodomas</option></select></li>
                        <li><label>Naujas</label><select name="newItem" class="cms_dropdown"><option {if $entry_info.newItem=='1'}selected="selected"{/if} value="1">Taip</option><option {if $entry_info.newItem=='0'}selected="selected" value="0"{/if}>Ne</option></select></li>
                        <hr/>
                        <li><label>Savivaldybė</label>{$region}</li>
                        <li><label>Gyvenvietė</label>{$city}</li>
                        <li><label>Mikrorajonas</label>{$quarter}</li>
                        <li><label>Gatvė</label>{$streets}</li>
                        <li><label>Namo numeris</label>{$houseNr}{$showHouseNr} Rodyti</li>
                        <hr/>
                        <li><label>Plotas (m²)</label>{$size}</li>
                        <li><label>Sklypo plotas (a)</label>{$landSize}</li>
                        <li><label>Bendrijos pavadinimas</label>{$community}</li>
                        <li><label>Metai</label>{$years}</li>
                        <li><label>Pastato tipas</label>{$buildType}</li>
                        <li><label>Įrengimas</label>{$equipment}</li>
                        <hr/>
                        <li><label>Šildymas</label><span class="block">{$heating}</span></li>
                        <li><label>Kambarių sk.</label>{$roomAmount}</li>
                        <li><label>Aukštas</label>{$floor}</li>
                        <li><label>Aukštų sk.</label>{$floorNr}</li>
                        <li><label>Artimiausias vandens telkinys</label>{$waterSource}</li>
                        <li><label>Iki vandens telkinio (m)</label>{$waterDistance}</li>
                        <hr/>
                        <li><label>Vanduo</label><span class="block">{$water}</span></li>
                        <hr/>
                        <li><label>Ypatybės</label><span class="block">{$addOptions}</span></li>
                        <hr/>
                        <li><label>Papildomos patalpos</label><span class="block">{$addRooms}</span></li>
                        <hr/>
                        <li><label>Papildoma įranga</label><span class="block">{$addEquipment}</span></li>
                        <hr/>
                        <li><label>Apsauga</label><span class="block">{$security}</span></li>
                        <hr/>
                        <li><label>Komentaras</label>
                            <span class="block komentarai">
                                <span>
                                    <a href="javascript:void(0)" onclick="showComment('lt', this)"><img src="/modules/NTmodulis/images/lt.png" alt=""></a>
                                    <a href="javascript:void(0)" onclick="showComment('en', this)"><img src="/modules/NTmodulis/images/en.png" alt=""></a>
                                    <a href="javascript:void(0)" onclick="showComment('ru', this)"><img src="/modules/NTmodulis/images/ru.png" alt=""></a>
                                </span>
                                <span>
                                    {$notes_lt}
                                    {$notes_en}
                                    {$notes_ru}
                                </span>
                            </span>
                        </li>
                        <hr/>
                        <li><label>Nuotraukos</label>
                            <span class="block">
                                {$imagesList}<input multiple="true" accept=".jpg,.gif,.png" name="photos[]" type="file">
                            </span>
                        </li>
                        <hr/>
                        <li><label>Videonuoroda</label>{$videoUrl}</li>
                        <hr/>
                        <li><label>Pastabos apie savininką<br/>(Nematoma)</label><span class="block">{$ownerComment}</span></li>
                        <hr/>
                        {if $entry_info.sellAction==1}<li><label>Kaina</label>{$price} €</li>{else}
                        <li><label>Kaina (mėn)</label>{$price} €</li>{/if}
                        {if $entry_info.sellAction==1}<li><label>Domina keitimas</label><span class="block">{$swap}</span></li>{/if}
                        <hr/>
                        <li><input value="Save" name="edit" type="submit">&nbsp;<input value="Cancel" name="cancel" type="submit"></li>
                    </ul></form>
            </div>
            <div class="sklypas tipas" {if $entry_info.itemType=='sklypas'}style="display: block"{/if}>
                <form method="post" enctype="multipart/form-data" action="">
                <ul>
                        <li><label>Rodymas</label><select name="state" class="cms_dropdown"><option {if $entry_info.state=='active'}selected="selected"{/if} value="active">Rodomas</option><option {if $entry_info.state=='inactive'}selected="selected"{/if} value="inactive">Nerodomas</option></select></li>
                        <li><label>Naujas</label><select name="newItem" class="cms_dropdown"><option {if $entry_info.newItem=='1'}selected="selected"{/if} value="1">Taip</option><option {if $entry_info.newItem=='0'}selected="selected" value="0"{/if}>Ne</option></select></li>
                        <hr/>
                        <li><label>Savivaldybė</label>{$region}</li>
                        <li><label>Gyvenvietė</label>{$city}</li>
                        <li><label>Mikrorajonas</label>{$quarter}</li>
                        <li><label>Gatvė</label>{$streets}</li>
                        <li><label>Sklypo numeris</label>{$landSizeNr}{$showLandSizeNr} Rodyti</li>
                        <hr/>
                        <li><label>Sklypo plotas (a)</label>{$landSize}</li>
                        <hr/>
                        <li><label>Paskirtis</label><span class="block">{$purpose}</span></li>
                        <hr/>
                        <li><label>Ypatybės</label><span class="block">{$addOptionsSklypas}</span></li>
                        <hr/>
                        <li><label>Komentaras</label>
                            <span class="block komentarai">
                                <span>
                                    <a href="javascript:void(0)" onclick="showComment('lt', this)"><img src="/modules/NTmodulis/images/lt.png" alt=""></a>
                                    <a href="javascript:void(0)" onclick="showComment('en', this)"><img src="/modules/NTmodulis/images/en.png" alt=""></a>
                                    <a href="javascript:void(0)" onclick="showComment('ru', this)"><img src="/modules/NTmodulis/images/ru.png" alt=""></a>
                                </span>
                                <span>
                                    {$notes_lt}
                                    {$notes_en}
                                    {$notes_ru}
                                </span>
                            </span>
                        </li>
                        <hr/>
                        <li><label>Nuotraukos</label>
                            <span class="block">
                                {$imagesList}<input multiple="true" accept=".jpg,.gif,.png" name="photos[]" type="file">
                            </span>
                        </li>
                        <hr/>
                        <li><label>Videonuoroda</label>{$videoUrl}</li>
                        <hr/>
                        <li><label>Pastabos apie savininką<br/>(Nematoma)</label><span class="block">{$ownerComment}</span></li>
                        <hr/>
                        {if $entry_info.sellAction==1}<li><label>Kaina</label>{$price} €</li>{else}
                        <li><label>Kaina (mėn)</label>{$price} €</li>{/if}
                        {if $entry_info.sellAction==1}<li><label>Domina keitimas</label><span class="block">{$swap}</span></li>{/if}
                        <hr/>
                        <li><input value="Save" name="edit" type="submit">&nbsp;<input value="Cancel" name="cancel" type="submit"></li>
                    </ul></form>
            </div>
            <div class="patalpa tipas" {if $entry_info.itemType=='patalpa'}style="display: block"{/if}>
                <form method="post" enctype="multipart/form-data" action="">
                <ul>
                        <li><label>Rodymas</label><select name="state" class="cms_dropdown"><option {if $entry_info.state=='active'}selected="selected"{/if} value="active">Rodomas</option><option {if $entry_info.state=='inactive'}selected="selected"{/if} value="inactive">Nerodomas</option></select></li>
                        <li><label>Naujas</label><select name="newItem" class="cms_dropdown"><option {if $entry_info.newItem=='1'}selected="selected"{/if} value="1">Taip</option><option {if $entry_info.newItem=='0'}selected="selected" value="0"{/if}>Ne</option></select></li>
                        <hr/>
                        <li><label>Savivaldybė</label>{$region}</li>
                        <li><label>Gyvenvietė</label>{$city}</li>
                        <li><label>Mikrorajonas</label>{$quarter}</li>
                        <li><label>Gatvė</label>{$streets}</li>
                        <li><label>Namo numeris</label>{$houseNr}{$showHouseNr} Rodyti</li>

                        <li><label>Patalpų numeris</label>{$premisesNr}{$showPremisesNr} Rodyti</li>
                        <hr/>
                        <li><label>Daugiau patalpų šiame pastate</label>{$morePremises}</li>
                        <li><label>Sklypo plotas (a)</label>{$landSize}</li>
                        {if $morePremises==1}
                            <li class="morePremises"><label>Bendras plotas (m²)</label><span class="block">Nuo {$sizeFrom} m² – Iki {$sizeTo} m²</span></li>
                            <li class="morePremises"><label>Aukštas</label><span class="block">Nuo {$floorFrom} – Iki {$floorTo}</span></li>
                            <li class="noMorePremises" style="display: none"><label>Bendras plotas (m²)</label><span class="block"> {$sizeFull} m²</span></li>
                            <li class="noMorePremises" style="display: none"><label>Aukštas</label><span class="block">{$floor}</span></li>
                        {else}
                            <li class="morePremises" style="display: none"><label>Bendras plotas (m²)</label><span class="block">Nuo {$sizeFrom} m² – Iki {$sizeTo} m²</span></li>
                            <li class="morePremises" style="display: none"><label>Aukštas</label><span class="block">Nuo {$floorFrom} – Iki {$floorTo}</span></li>
                            <li class="noMorePremises"><label>Bendras plotas (m²)</label><span class="block"> {$sizeFull} m²</span></li>
                            <li class="noMorePremises"><label>Aukštas</label><span class="block">{$floor}</span></li>
                        {/if}
                        <li><label>Įrengimas</label>{$equipment}</li>
                        <hr/>
                        <li><label>Paskirtis</label><span class="block">{$purposePatalpos}</span></li>
                        {if $morePremises==1}
                            <li class="morePremises"><label>Patalpų skaičius</label><span class="block">Nuo {$premisesAmountFrom} – Iki {$premisesAmountTo}</span></li>
                            <li class="noMorePremises" style="display: none"><label>Patalpų skaičius</label><span class="block">{$premisesAmount}</span></li>
                        {else}
                            <li class="morePremises" style="display: none"><label>Patalpų skaičius</label><span class="block">Nuo {$premisesAmountFrom} – Iki {$premisesAmountTo}</span></li>
                            <li class="noMorePremises"><label>Patalpų skaičius</label><span class="block">{$premisesAmount}</span></li>
                        {/if}
                        <li><label>Aukštų sk.</label>{$floorNr}</li>
                        <li><label>Metai</label>{$years}</li>
                        <hr/>
                        <li><label>Vanduo</label><span class="block">{$water}</span></li>
                        <hr/>
                        <li><label>Šildymas</label><span class="block">{$heating}</span></li>
                        <hr/>
                        <li><label>Ypatybės</label><span class="block">{$addOptionsPatalp}</span></li>
                        <hr/>
                        <li><label>Papildoma įranga</label><span class="block">{$addEquipment}</span></li>
                        <hr/>
                        <li><label>Apsauga</label><span class="block">{$security}</span></li>
                        <hr/>
                        <li><label>Komentaras</label>
                            <span class="block komentarai">
                                <span>
                                    <a href="javascript:void(0)" onclick="showComment('lt', this)"><img src="/modules/NTmodulis/images/lt.png" alt=""></a>
                                    <a href="javascript:void(0)" onclick="showComment('en', this)"><img src="/modules/NTmodulis/images/en.png" alt=""></a>
                                    <a href="javascript:void(0)" onclick="showComment('ru', this)"><img src="/modules/NTmodulis/images/ru.png" alt=""></a>
                                </span>
                                <span>
                                    {$notes_lt}
                                    {$notes_en}
                                    {$notes_ru}
                                </span>
                            </span>
                        </li>
                        <hr/>
                        <li><label>Nuotraukos</label>
                            <span class="block">
                                {$imagesList}<input multiple="true" accept=".jpg,.gif,.png" name="photos[]" type="file">
                            </span>
                        </li>
                        <hr/>
                        <li><label>Videonuoroda</label>{$videoUrl}</li>
                        <hr/>
                        <li><label>Pastabos apie savininką<br/>(Nematoma)</label><span class="block">{$ownerComment}</span></li>
                        <hr/>
                        {if $entry_info.sellAction==1}<li class=""><label>Kaina</label><span class="block">{$price}€</span></li>{else}
                        <li class=""><label>Kaina (mėn)</label><span class="block">Nuo {$priceFrom} – Iki {$priceTo}€</span></li>{/if}
                        {if $entry_info.sellAction==1}<li class=""><label>Domina keitimas</label><span class="block">{$swap}</span></li>{/if}
                        <hr/>
                        <li><input value="Save" name="edit" type="submit">&nbsp;<input value="Cancel" name="cancel" type="submit"></li>
                    </ul></form>
            </div>
            <div class="garazas tipas" {if $entry_info.itemType=='garazas'}style="display: block"{/if}>
                <form method="post" enctype="multipart/form-data" action="">
                <ul>
                        <li><label>Rodymas</label><select name="state" class="cms_dropdown"><option {if $entry_info.state=='active'}selected="selected"{/if} value="active">Rodomas</option><option {if $entry_info.state=='inactive'}selected="selected"{/if} value="inactive">Nerodomas</option></select></li>
                        <li><label>Naujas</label><select name="newItem" class="cms_dropdown"><option {if $entry_info.newItem=='1'}selected="selected"{/if} value="1">Taip</option><option {if $entry_info.newItem=='0'}selected="selected" value="0"{/if}>Ne</option></select></li>
                        <hr/>
                        <li><label>Savivaldybė</label>{$region}</li>
                        <li><label>Gyvenvietė</label>{$city}</li>
                        <li><label>Mikrorajonas</label>{$quarter}</li>
                        <li><label>Gatvė</label>{$streets}</li>
                        <hr/>
                        <li><label>Plotas (m²)</label>{$size}</li>
                        <li><label>Garažo tipas</label>{$garageType}</li>
                        <li><label>Telpa automobilių</label>{$garageSize}</li>
                        <li><label>Metai</label>{$years}</li>
                        <hr/>
                        <li><label>Ypatybės</label><span class="block">{$addOptionsGaraz}</span></li>
                        <hr/>
                        <li><label>Komentaras</label>
                            <span class="block komentarai">
                                <span>
                                    <a href="javascript:void(0)" onclick="showComment('lt', this)"><img src="/modules/NTmodulis/images/lt.png" alt=""></a>
                                    <a href="javascript:void(0)" onclick="showComment('en', this)"><img src="/modules/NTmodulis/images/en.png" alt=""></a>
                                    <a href="javascript:void(0)" onclick="showComment('ru', this)"><img src="/modules/NTmodulis/images/ru.png" alt=""></a>
                                </span>
                                <span>
                                    {$notes_lt}
                                    {$notes_en}
                                    {$notes_ru}
                                </span>
                            </span>
                        </li>
                        <hr/>
                        <li><label>Nuotraukos</label>
                            <span class="block">
                                {$imagesList}<input multiple="true" accept=".jpg,.gif,.png" name="photos[]" type="file">
                            </span>
                        </li>
                        <hr/>
                        <li><label>Videonuoroda</label>{$videoUrl}</li>
                        <hr/>
                        <li><label>Pastabos apie savininką<br/>(Nematoma)</label><span class="block">{$ownerComment}</span></li>
                        <hr/>
                        {if $entry_info.sellAction==1}<li class=""><label>Kaina</label>{$price} €</li>{else}
                        <li class=""><label>Kaina (mėn)</label>{$price} €</li>{/if}
                        {if $entry_info.sellAction==1}<li class=""><label>Domina keitimas</label><span class="block">{$swap}</span></li>{/if}
                        <hr/>
                        <li><input value="Save" name="edit" type="submit">&nbsp;<input value="Cancel" name="cancel" type="submit"></li>
                    </ul></form>
            </div>
            <div class="nuoma tipas" {if $entry_info.itemType=='nuoma'}style="display: block"{/if}>
                <form method="post" enctype="multipart/form-data" action="">
                <input name="sellAction" hidden="hidden" value="2"/>
                <ul>
                        <li><label>Rodymas</label><select name="state" class="cms_dropdown"><option {if $entry_info.state=='active'}selected="selected"{/if} value="active">Rodomas</option><option {if $entry_info.state=='inactive'}selected="selected"{/if} value="inactive">Nerodomas</option></select></li>
                        <li><label>Naujas</label><select name="newItem" class="cms_dropdown"><option {if $entry_info.newItem=='1'}selected="selected"{/if} value="1">Taip</option><option {if $entry_info.newItem=='0'}selected="selected" value="0"{/if}>Ne</option></select></li>
                        <hr/>
                        <li><label>Savivaldybė</label>{$region}</li>
                        <li><label>Gyvenvietė</label>{$city}</li>
                        <li><label>Mikrorajonas</label>{$quarter}</li>
                        <li><label>Gatvė</label>{$streets}</li>
                        <li><label>Namo numeris</label>{$houseNr}{$showHouseNr} Rodyti</li>
                        <hr/>
                        <li><label>Bendras plotas (m²)</label>{$sizeFull}</li>
                        <li><label>Tipas</label>{$sellTypeGaraz}</li>
                        <li><label>Kambarių sk.</label>{$roomAmount}</li>
                        <li><label>Aukštas</label>{$floor}</li>
                        <li><label>Aukštų sk.</label>{$floorNr}</li>
                        <li><label>Miegamosios vietos</label>{$sleepPlace}</li>
                        <hr/>
                        <li><label>Ypatybės</label><span class="block">{$addOptionsNuoma}</span></li>
                        <hr/>
                        <li><label>Komentaras</label>
                            <span class="block komentarai">
                                <span>
                                    <a href="javascript:void(0)" onclick="showComment('lt', this)"><img src="/modules/NTmodulis/images/lt.png" alt=""></a>
                                    <a href="javascript:void(0)" onclick="showComment('en', this)"><img src="/modules/NTmodulis/images/en.png" alt=""></a>
                                    <a href="javascript:void(0)" onclick="showComment('ru', this)"><img src="/modules/NTmodulis/images/ru.png" alt=""></a>
                                </span>
                                <span>
                                    {$notes_lt}
                                    {$notes_en}
                                    {$notes_ru}
                                </span>
                            </span>
                        </li>
                        <hr/>
                        <li><label>Nuotraukos</label>
                            <span class="block">
                                {$imagesList}<input multiple="true" accept=".jpg,.gif,.png" name="photos[]" type="file">
                            </span>
                        </li>
                        <hr/>
                        <li><label>Videonuoroda</label>{$videoUrl}</li>
                        <hr/>
                        <li><label>Pastabos apie savininką<br/>(Nematoma)</label><span class="block">{$ownerComment}</span></li>
                        <hr/>
                        <li class=""><label>Kaina</label>{$price} €</li>
                        <hr/>
                        <li><input value="Save" name="edit" type="submit">&nbsp;<input value="Cancel" name="cancel" type="submit"></li>
                    </ul></form>
            </div>
        </div>
    {$tab_end}
{/if}
{if $start_vadyb_tab != ''}
    {$start_vadyb_tab}
        <div >
            <form method="post" >
            Filtravimas: {if $adminLogged==1}<select name="vadyb" class="" id="vadyb">
                <option value="">Vadybininkas</option>
                {$vadyb}
            </select>{/if}
            <input style="margin: 0; top: -1px" type="submit" name="filterVadybList" value="Filtruoti"/>
            </form>
            <br/>
            <br/>
            <form method="post" >
            <table class="skelbList" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                    <td width="500">
                        <b>Skelbimo ID</b>
                    </td>
                    <td width="200">
                        <b>Būsena</b>
                    </td>
                    <td width="200">
                        <b>Tipas</b>
                    </td>
                    <td width="200">
                        <b>Vadybininkas</b>
                    </td>
                </tr>
            {foreach from=$skelbimai item=entry}
                <tr class="skelb{$entry.id}">
                    <td style="padding: 5px 0;">{$entry.id}</td>
                    <td style="padding: 5px 0;">{if $entry.state=='inactive'}Nerodomas{else}Rodomas{/if}</td>
                    <td style="padding: 5px 0;">{if $entry.sellType!=''}{$entry.sellType|ucfirst}{else}{$entry.itemType|ucfirst}{/if}</td>
                    <td style="padding: 5px 0; text-align: right;">
                    <input name="skelbID[]" value="{$entry.id}" type="hidden"/>
                    <select name="vadyb[]" class="" id="vadyb">
                    {foreach from=$users item=user}
                        <option {if $entry.userID==$user.user_id}selected="selected"{/if} value="{$user.user_id}">{$user.first_name} {$user.last_name}</option>
                    {/foreach}

            </select></td>
                </tr>
            {/foreach}
            </table>
            <br/><br/>
            <input type="submit" value="Atnaujinti" name="updateVadyb"/>&nbsp;<input value="Cancel" name="cancel" type="submit">
            </form>
        </div>
    {$tab_end}
{/if}
{if $start_gatve_tab != ''}
    {$start_gatve_tab}
        <div class="tipas" style="display: block">
            <form method="post" enctype="multipart/form-data" action="">
                <ul>
                    <li><label>Savivaldybė</label>{$region}</li>
                    <li><label>Gyvenvietė</label>{$city}</li>
                    <li><label>Gatvė</label><input type="text" name="gatve"/></li>
                </ul>
                <br/><br/>
                <input type="submit" value="Pridėti" name="addNewStreet"/>&nbsp;<input value="Cancel" name="cancel" type="submit">
            </form>

        </div>
    {$tab_end}
{/if}
{if $start_mikroraj_tab != ''}
    {$start_mikroraj_tab}
        <div class="tipas" style="display: block">
            <form method="post" enctype="multipart/form-data" action="">
                <ul>
                    <li><label>Savivaldybė</label>{$region}</li>
                    <li><label>Gyvenvietė</label>{$city}</li>
                    <li><label>Mikrorajonas</label><input type="text" name="mikroraj"/></li>
                </ul>
                <br/><br/>
                <input type="submit" value="Pridėti" name="addNewMikroRaj"/>&nbsp;<input value="Cancel" name="cancel" type="submit">
            </form>

        </div>
    {$tab_end}
{/if}
{$tabs_end}


@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script>

        $('select[name="region"]').change(function(){
            const id = $(this).val()
            $.get(`/admin/getRegion?region=${id}`,{},function(data){
                if(data){
                    // console.log(data);

                //    const arr = data.map(item => `<option value="${item.id}">${item.miestas_name}</option>`)
                   $('select[name="miestas"]').html(data)
                }

            })

        })




    </script>
@endpush
