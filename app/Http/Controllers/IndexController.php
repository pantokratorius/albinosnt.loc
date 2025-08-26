<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;


// qnXMZ3h*uljB(YtZ
class IndexController extends BaseController
{

  public function __construct(Request $request)
  {
    parent::__construct($request);
    $this->active_main_menu_link = 'homepage';

    $this->init();
  }


    public function index(Request $request){

        // if(!empty(session('condition'))){
        //     $where['condition'] = session('condition');
        //     $where['param'] = session('param');
        // }else{

            $this->where['condition'][] = 'itemType = ?';
            $this->where['param'][] = 'butas';
            $request->session()->forget('itemType');
            $request->session()->forget('sellAction');
            $request->session()->forget('condition');
            $request->session()->forget('param');


            // $where['condition'] = $this->where['condition'];
            // $where['param'] = $this->where['param'];
        // }

         $data = DB::table('cms_module_ntmodulis')
            ->select('*')
            // ->where($this->where)
             ->whereRaw(implode(' AND ', $this->where['condition']), $this->where['param'])
            ->orderBy('cms_module_ntmodulis.create_date', 'desc')
            ->paginate(12);

            $sellaction = 1;
            $itemtype = 'butas';
            $request->session()->put('itemType', 'butas');


// dd($data);
             $photo = [];  $region = []; $quarter = []; $city = []; $streets = []; $userID = [];


            foreach($data as $k => $v){
                if($v->photos != ''){
                    $photos  = explode(';', $v->photos);
                    if(is_array($photos))
                        $photos = $photos[0];
                    $photo[$v->id] = $photos;
                }
                if($v->region > 0){
                    $region_value = DB::table('vietove')->find($v->region);
                    $region[$v->id] = !empty($region_value) ?  $region_value->vietove_name : '';
                }
                if($v->quarter > 0){
                    $quarter_value = DB::table('kvartalas')->find($v->quarter);
                    $quarter[$v->id] = !empty($quarter_value) ? $quarter_value->kvartalas_name : '';
                }
                if($v->city > 0){
                    $city_value = DB::table('miestas')->find($v->city);
                    $city[$v->id] = !empty($city_value) ? $city_value->miestas_name : '';
                }
                if($v->streets > 0){
                    $streets_value = DB::table('gatves')->find($v->streets);
                    $streets[$v->id] = !empty($streets_value) ? $streets_value->gatve_name : '';
                }
                if($v->userID > 0){
                    $userID_value = DB::table('users')->find($v->userID);
                    $userID[$v->id] = !empty($userID_value) ? $userID_value->first_name . ' ' . $userID_value->last_name  : '';
                }
                if(isset($v->notes_lt)){
                    $v->notes_lt = $this->modifyDescription($v->notes_lt);
                }elseif(isset($v->notes_ru)){
                    $v->notes_ru = $this->modifyDescription($v->notes_ru);
                }

            }

            if(isset($request->type ) && $request->type == 'simple'){
                $request->session()->put('type', 'simple');
            }
            elseif(isset($request->type ) && $request->type == 'tile'){
                $request->session()->put('type', 'tile');
            }

            // $active_main_menu_link = 'homepage';

             return view('frontend.welcome',
                compact('data', 'photo', 'region', 'quarter', 'city', 'streets', 'userID', 'itemtype')
            );

    }




    public function itemtype(Request $request){

            $sellaction = 1;
            $itemtype = '';

        if(isset($request->itemtype)){
            $itemtype = $request->itemtype;

            $trans =[
                'квартира' => 'butas',
                    'дом' => 'namas',
                    'усадьба' => 'sodyba',
                    'участок' => 'sklypas',
                    'сад' => 'sodas',
                    'помещение' => 'patalpa',
                ];
                if(array_key_exists($itemtype, $trans)){
                    $itemtype = $trans[$itemtype];
            }
            $request->session()->put('itemType', $itemtype);
            $request->session()->forget('sellAction');
            $request->session()->forget('condition');
            $request->session()->forget('param');
            $sellaction = 1;
            $this->sellaction = 1;
            $this->where['condition'][] = 'itemType = ?';
            $this->where['param'][] = $itemtype;

            $request->session()->forget('condition');
            $request->session()->forget('param');
        }
        else{
            if(!empty($request->session()->get('itemType'))){
                $type = $request->session()->get('itemType');
                $this->itemtype = $type;
                $itemtype = $type;
                $sellaction = 1;
                $this->where['condition'][] = 'itemType = ?';
                $this->where['param'][] =  $type;
                $request->session()->forget('condition');
                $request->session()->forget('param');
            }
            else {
                $this->itemtype = 'butas';
                $itemtype = 'butas';
                $sellaction = 1;
                $this->where['condition'][] = 'itemType = ?';
                $this->where['param'][] = 'butas';

                $request->session()->forget('condition');
                $request->session()->forget('param');
            }
        }



         $data = DB::table('cms_module_ntmodulis')
            ->select('*')
            // ->where($this->where)
             ->whereRaw(implode(' AND ', $this->where['condition']), $this->where['param'])
            ->orderBy('cms_module_ntmodulis.create_date', 'desc')
            ->paginate(12);




// dd($data);
             $photo = [];  $region = []; $quarter = []; $city = []; $streets = []; $userID = [];


            foreach($data as $k => $v){
                if($v->photos != ''){
                    $photos  = explode(';', $v->photos);
                    if(is_array($photos))
                        $photos = $photos[0];
                    $photo[$v->id] = $photos;
                }
                if($v->region > 0){
                    $region_value = DB::table('vietove')->find($v->region);
                    $region[$v->id] = !empty($region_value) ?  $region_value->vietove_name : '';
                }
                if($v->quarter > 0){
                    $quarter_value = DB::table('kvartalas')->find($v->quarter);
                    $quarter[$v->id] = !empty($quarter_value) ? $quarter_value->kvartalas_name : '';
                }
                if($v->city > 0){
                    $city_value = DB::table('miestas')->find($v->city);
                    $city[$v->id] = !empty($city_value) ? $city_value->miestas_name : '';
                }
                if($v->streets > 0){
                    $streets_value = DB::table('gatves')->find($v->streets);
                    $streets[$v->id] = !empty($streets_value) ? $streets_value->gatve_name : '';
                }
                if($v->userID > 0){
                    $userID_value = DB::table('users')->find($v->userID);
                    $userID[$v->id] = !empty($userID_value) ? $userID_value->first_name . ' ' . $userID_value->last_name  : '';
                }
                if(isset($v->notes_lt)){
                    $v->notes_lt = $this->modifyDescription($v->notes_lt);
                }elseif(isset($v->notes_ru)){
                    $v->notes_ru = $this->modifyDescription($v->notes_ru);
                }
            }

            if(isset($request->type ) && $request->type == 'simple'){
                $request->session()->put('type', 'simple');
            }
            elseif(isset($request->type ) && $request->type == 'tile'){
                $request->session()->put('type', 'tile');
            }


            $scroll = null;
            $active_main_menu_link = 'homepage';

             return view('frontend.welcome',
                compact('data', 'photo', 'region', 'quarter', 'city', 'streets', 'userID',  'itemtype', 'sellaction', 'scroll', 'active_main_menu_link')
            );

    }



    public function sellaction(Request $request){

            $sellaction = 1;
            $itemtype = '';

            $request->session()->put('sellAction',2);
            $request->session()->forget('itemType');
            $request->session()->forget('condition');
            $request->session()->forget('param');
            $this->sellaction = 2;
            $sellaction = 2;
            $this->itemtype = '';
            $itemtype = '';

            $this->where['condition'][] = 'sellAction = ?';
            $this->where['param'][] = 2;
            $request->session()->forget('condition');
            $request->session()->forget('param');


// dd($request);




         $data = DB::table('cms_module_ntmodulis')
            ->select('*')
            // ->where($this->where)
             ->whereRaw(implode(' AND ', $this->where['condition']), $this->where['param'])
            ->orderBy('cms_module_ntmodulis.create_date', 'desc')
            ->paginate(12);




// dd($data);
             $photo = [];  $region = []; $quarter = []; $city = []; $streets = []; $userID = [];


            foreach($data as $k => $v){
                if($v->photos != ''){
                    $photos  = explode(';', $v->photos);
                    if(is_array($photos))
                        $photos = $photos[0];
                    $photo[$v->id] = $photos;
                }
                if($v->region > 0){
                    $region_value = DB::table('vietove')->find($v->region);
                    $region[$v->id] = !empty($region_value) ?  $region_value->vietove_name : '';
                }
                if($v->quarter > 0){
                    $quarter_value = DB::table('kvartalas')->find($v->quarter);
                    $quarter[$v->id] = !empty($quarter_value) ? $quarter_value->kvartalas_name : '';
                }
                if($v->city > 0){
                    $city_value = DB::table('miestas')->find($v->city);
                    $city[$v->id] = !empty($city_value) ? $city_value->miestas_name : '';
                }
                if($v->streets > 0){
                    $streets_value = DB::table('gatves')->find($v->streets);
                    $streets[$v->id] = !empty($streets_value) ? $streets_value->gatve_name : '';
                }
                if($v->userID > 0){
                    $userID_value = DB::table('users')->find($v->userID);
                    $userID[$v->id] = !empty($userID_value) ? $userID_value->first_name . ' ' . $userID_value->last_name  : '';
                }
            }

            if(isset($request->type ) && $request->type == 'simple'){
                $request->session()->put('type', 'simple');
            }
            elseif(isset($request->type ) && $request->type == 'tile'){
                $request->session()->put('type', 'tile');
            }

            $active_main_menu_link = 'homepage';


             return view('frontend.welcome',
                compact('data', 'photo', 'region', 'quarter', 'city', 'streets', 'userID',  'itemtype', 'sellaction', 'active_main_menu_link')
            );

    }



    public function item($id){


        $data = []; $photos = []; $region = ''; $quarter = ''; $city = ''; $streets = ''; $user_data = [];

        $data = DB::table('cms_module_ntmodulis')
            ->find($id);


        $trans = [
            'buildType',
            'equipment',
            'heating',
            'addOptions',
            'addEquipment',
            'security',
        ];






            // dd($data);

        if(!$data) return Redirect::back();

        foreach($data as $k => $v){
            if(in_array($k, $trans) && !empty($v)){
                $temp_arr = []; $temp = null;
                $temp = explode(';', $v);
                foreach($temp as $key => $val){
                    $temp_arr[$key] = __('components.' .$val);
                }
                $data->$k = implode(', ', $temp_arr);
            }
        }

             if($data->photos != ''){
                    $photos  = explode(';', $data->photos);
                }
                if($data->region > 0){
                    $region = DB::table('vietove')->find($data->region);
                    if($region) $region = $region->vietove_name;
                }
                if($data->quarter > 0){
                    $quarter = DB::table('kvartalas')->find($data->quarter);
                    if($quarter) $quarter = $quarter->kvartalas_name;
                }
                if($data->city > 0){
                    $city = DB::table('miestas')->find($data->city);
                    if($city)  $city =  $city->miestas_name;
                }
                if($data->streets > 0){
                    $streets = DB::table('gatves')->find($data->streets);
                    if($streets) $streets = $streets->gatve_name;
                }
                if($data->userID > 0){
                    $userID = DB::table('users')->find($data->userID);
                    if($userID){
                        $user_data['name'] = $userID->first_name . ' ' . $userID->last_name ;
                        $user_data['phone'] = substr($userID->phone, 0, 4) .' ' . substr($userID->phone,4, 3) .' ' . substr($userID->phone,7);
                        $user_data['email'] = $userID->email;
                        $user_data['photo'] = $userID->photo;
                    }
                }

        $itemtype = '';
        $sellaction = '';

        if(!empty(session('condition'))){
            $where['condition'] = session('condition');
            $where['param'] = session('param');
            $itemtype = session('itemType');
        }elseif(!empty(session('itemType'))){
            $where['condition'][]= 'itemType = ?';
            $where['param'] = session('itemType');
            $itemtype = session('itemType');
        }elseif(!empty(session('sellAction'))){
            $where['condition'][]= 'sellAction = ?';
            $where['param'] = session('sellAction');
            $itemtype = '';
            $sellaction = 2;
        }else{
            $where['condition'][]= 'itemType = ?';
            $where['param']= 'butas';
            $itemtype = 'butas';
        }
         $similar = DB::table('cms_module_ntmodulis')
            ->select('*')
            ->whereRaw(implode(' AND ', $where['condition']), $where['param'])
            ->inRandomOrder()
            ->limit(4)
            ->get();

$streets_sim = []; $city_sim = [];
            foreach($similar as $k=>$v){
                  if($v->photos != ''){
                    $images  = explode(';', $v->photos);

                    if(is_array($images))
                        $images = $images[0];
                    $image[$v->id] = $images;
                }else{
                    $image[$v->id] = '';
                }


                if($v->city > 0){
                    $city_value = DB::table('miestas')->find($v->city);
                    $city_sim[$v->id] = !empty($city_value) ? $city_value->miestas_name : '';
                }
                if($v->streets > 0){
                    $streets_value = DB::table('gatves')->find($v->streets);
                    $streets_sim[$v->id] = !empty($streets_value) ? $streets_value->gatve_name : '';
                }
                 if(isset($v->notes_lt)){
                    $v->notes_lt = $this->modifyDescription($v->notes_lt);
                }elseif(isset($v->notes_ru)){
                    $v->notes_ru = $this->modifyDescription($v->notes_ru);
                }

            }


             $active_main_menu_link = 'homepage';

             return view('frontend.item',
                compact('data', 'photos', 'region', 'quarter', 'city',
                 'streets', 'user_data', 'similar', 'image',
                 'itemtype', 'sellaction', 'active_main_menu_link', 'city_sim', 'streets_sim')
            );


    }


    public function search(Request $request) {



            
// dd($request->all());
        if($request->filled('floor_from')){
                $this->where['condition'][] = '(floor >= ? OR floorNr >= ?)';
                $this->where['param'][] = $request->input('floor_from');
                $this->where['param'][] = $request->input('floor_from');
            }
            if($request->filled('area_from')){
                $this->where['condition'][] = 'size >= ?';
                $this->where['param'][] = $request->input('area_from');
            }
            if($request->filled('area_to')){
                $this->where['condition'][] = 'size <= ?';
                $this->where['param'][] = $request->input('area_to');
            }
            if($request->filled('buildType')){
                $this->where['condition'][] = 'buildType = ?';
                $this->where['param'][] = $request->input('buildType');
            }
            if($request->filled('floor_to')){
                $this->where['condition'][] = '(floor <= ? OR floorNr <= ?)';
                $this->where['param'][] =  $request->input('floor_to');
                $this->where['param'][] =  $request->input('floor_to');
            }
            if($request->filled('price_from')){
                $this->where['condition'][] = 'price >= ?';
                $this->where['param'][] =  $request->input('price_from');
            }
            if($request->filled('price_to')){
                $this->where['condition'][] = 'price <= ?';
                $this->where['param'][] =  $request->input('price_to');
            }
            if($request->filled('roomAmount_from')){
                $this->where['condition'][] = 'roomAmount >= ?';
                $this->where['param'][] =  $request->input('roomAmount_from');
            }
            if($request->filled('years_from')){
                $this->where['condition'][] = 'years >= ?';
                $this->where['param'][] =  $request->input('years_from');
            }
            if($request->filled('roomAmount_to')){
                $this->where['condition'][] = 'roomAmount <= ?';
                $this->where['param'][] =  $request->input('roomAmount_to');
            }
            if($request->filled('years_to')){
                $this->where['condition'][] = 'years <= ?';
                $this->where['param'][] =  $request->input('years_to');
            }
            if($request->filled('roomAmount_to')){
                $this->where['condition'][] = 'roomAmount <= ?';
                $this->where['param'][] =  $request->input('roomAmount_to');
            }
            if($request->filled('with_photos')){
                $this->where['condition'][] = 'photos != ?';
                $this->where['param'][] =  '';
            }

            if($request->filled('sellType')){
                $this->where['condition'][] = 'sellType = ?';
                $this->where['param'][] =  $request->input('sellType');
            }
             if($request->filled('landSize_from')){
                $this->where['condition'][] = 'landSize >= ?';
                $this->where['param'][] =  $request->input('landSize_from');
            }
            if($request->filled('landSize_to')){
                $this->where['condition'][] = 'landSize <= ?';
                $this->where['param'][] =  $request->input('landSize_to');
            }
            if($request->filled('community')){
                $this->where['condition'][] = 'community = ?';
                $this->where['param'][] =  $request->input('community');
            }
            if($request->filled('region')){
                $this->where['condition'][] = 'region = ?';
                $this->where['param'][] =  $request->input('region');
            }
            if($request->filled('city')){
                $this->where['condition'][] = 'city = ?';
                $this->where['param'][] =  $request->input('city');
            }


// dd($request->filled('heating'));
            if($request->filled('heating')){

                $trans = [
                     'Центральное' => 'Centrinis',
                    'Электрическое' => 'Elektra',
                    'На жидком топливе' => 'Skystu kuru',
                    'Центральное коллекторное' => 'Centrinis kolektorinis',
                    'Геотермальное' => 'Geoterminis',
                    'Аэротермальное' => 'Oroterminis',
                    'Газовое' => 'Dujinis',
                    'На твёрдом топливе' => 'Kietu kuru',
                    'Другое' => 'Kita',
                ];

                $temp_data = explode(';', $request->input('heating'));
                $condition = [];
                foreach($temp_data as $k => $v){
                    if(array_key_exists($v, $trans))
                        $v = $trans[$v];
                    $condition[] = 'heating LIKE "%'. $v.'%"';
                }
                $this->where['condition'][] = '(' . implode(' OR ', $condition) . ')';
            }
            if($request->filled('purpose')){

                $trans = [
                    'Жилая территория' => 'Namų valda',
                    'Многоквартирное строительство' => 'Daugiabučių statyba',
                    'Сельскохозяйственная' => 'Žemės ūkio',
                    'Участок в садах' => 'Sklypas soduose',
                    'Лесное хозяйство' => 'Miškų ūkio',
                    'Промышленная' => 'Pramonės',
                    'Складская' => 'Sandėliavimo',
                    'Коммерческая' => 'Komercinė',
                    'Рекреационная' => 'Rekreacinė',
                    'Другое' => 'Kita',
                ];
                $temp_data = explode(',', $request->input('purpose'));
                $condition = [];
                foreach($temp_data as $k => $v){
                    if(array_key_exists($v, $trans))
                        $v = $trans[$v];
                    $condition[] = 'purpose LIKE "%'. $v.'%"';
                }
                $this->where['condition'][] = '(' . implode(' OR ', $condition) . ')';
            }
           
            if($request->filled('purpose2')){

                $trans = [
                    'Административная' => 'Administracinė',
                    'Торговая' => 'Prekybos',
                    'Гостиничная' => 'Viešbučių',
                    'Обслуживания' => 'Paslaugų',
                    'Складская' => 'Sandėliavimo',
                    'Производственная и промышленная' => 'Gamybos ir pramonės',
                    'Общественного питания' => 'Maitinimo',
                    'Другое' => 'Kita',
                ];

                $temp_data = explode(',', $request->input('purpose2'));
                $condition = [];
                foreach($temp_data as $k => $v){
                    if(array_key_exists($v, $trans))
                        $v = $trans[$v];
                    $condition[] = 'purpose LIKE "%'. $v.'%"';
                }
                $this->where['condition'][] = '(' . implode(' OR ', $condition) . ')';
            }

            // if($request->filled('quarter') || $request->filled('street')){
                if($request->filled('quarter') && $request->filled('street')){
                    $this->where['condition'][] = '(quarter IN (' .$request->input('quarter') . ') OR streets IN (' .$request->input('street') . ') )';
                }
                elseif($request->filled('quarter')){
                    $this->where['condition'][] = 'quarter IN (' .$request->input('quarter') . ')';
                }
                elseif($request->filled('street')){
                    $this->where['condition'][] = 'streets IN (' .$request->input('street') . ')';
                }
            // }





            if($request->filled('additional_equipment')){

                $trans = [
                     'Кондиционер' => 'Kondicionierius',
                    'Стиральная машина' => 'Skalbimo mašina',
                    'С мебелью' => 'Su baldais',
                    'Холодильник' => 'Šaldytuvas',
                    'Тёплые полы' => 'Šildomos grindys',
                    'Кухонный гарнитур' => 'Virtuvės komplektas',
                    'Плита' => 'Viryklė',
                    'Камин' => 'Židinys',
                    'Трубы Wavin' => 'Wavin vamzdžiai',
                    'Посудомоечная машина' => 'Indaplovė',
                    'Душевая кабина' => 'Dušo kabina',
                    'Ванна' => 'Vonia',
                ];

                $temp_data = explode(',', $request->input('additional_equipment'));
                $condition = [];
                foreach($temp_data as $k => $v){
                    if(array_key_exists($v, $trans))
                        $v = $trans[$v];
                   $condition[] = 'addEquipment LIKE "%'. $v.'%"';
                }
                $this->where['condition'][] = '(' . implode(' OR ', $condition) . ')';
            }


// dd($condition);


            if($request->filled('search')){


                $region = DB::table('vietove')->whereRaw('vietove_name LIKE "%'.$request->input('search').'%" ')->pluck('id');
                $city = DB::table('miestas')->whereRaw('miestas_name LIKE "%'.$request->input('search').'%" ')->pluck('id');
                $quarter = DB::table('kvartalas')->whereRaw('kvartalas_name LIKE "%'.$request->input('search').'%" ')->pluck('id');
                $streets = DB::table('gatves')->whereRaw('gatve_name LIKE "%'.$request->input('search').'%" ')->pluck('id');

                $condition = 'id = ?';
                if(!empty($region->all())) $condition .= ' OR region IN ('.implode(',', $region->all()) .') ';
                if(!empty($city->all())) $condition .= ' OR city IN ('.implode(',', $city->all()) .') ';
                if(!empty($quarter->all())) $condition .= ' OR quarter IN ('.implode(',', $quarter->all()) .') ';
                if(!empty($streets->all())) $condition .= ' OR streets IN ('.implode(',', $streets->all()) .') ';

                $this->where['condition'][] = $condition;
                $this->where['param'] =  $request->input('search');

                $sellaction = '';
                $itemtype = '';

            }else {
                $sellaction = '';

                if(!empty($request->input('itemType'))){
                    $itemtype = $request->input('itemType');
                    $request->session()->put('itemType',$request->input('itemType'));
                }
                else $itemtype = session('itemType');

               
            }

// dd($this->where);

           if(!empty($this->where['condition'])){

                 if($itemtype){
                    $this->where['condition'][] = 'itemType = ?';
                    $this->where['param'][] =  $itemtype;
                }

                $this->where['condition'][] = 'sellaction = 1';

                 $request->session()->put('condition', $this->where['condition']);
                $request->session()->put('param', $this->where['param']);

                // $request->session()->forget('itemtype');
                // $request->session()->forget('sellaction');
           }elseif(!empty($request->session()->get('condition'))){
                $this->where['condition'] = $request->session()->get('condition');
                $this->where['param'] = $request->session()->get('param');
            }else{
                $this->where['condition'] = [1];
                $this->where['param'] = [];
           }


// dd($this->where);


           $data = DB::table('cms_module_ntmodulis')
            ->select('*')
            // ->where($this->where)
             ->whereRaw(implode(' AND ', $this->where['condition']), $this->where['param'])
            ->orderBy('cms_module_ntmodulis.create_date', 'desc')
            ->paginate(12);

// dd($data);

             $photo = [];  $region = []; $quarter = []; $city = []; $streets = []; $userID = [];


            foreach($data as $k => $v){
                if($v->photos != ''){
                    $photos  = explode(';', $v->photos);
                    if(is_array($photos))
                        $photos = $photos[0];
                    $photo[$v->id] = $photos;
                }
                if($v->region > 0){
                    $region_value = DB::table('vietove')->find($v->region);
                    $region[$v->id] = !empty($region_value) ?  $region_value->vietove_name : '';
                }
                if($v->quarter > 0){
                    $quarter_value = DB::table('kvartalas')->find($v->quarter);
                    $quarter[$v->id] = !empty($quarter_value) ? $quarter_value->kvartalas_name : '';
                }
                if($v->city > 0){
                    $city_value = DB::table('miestas')->find($v->city);
                    $city[$v->id] = !empty($city_value) ? $city_value->miestas_name : '';
                }
                if($v->streets > 0){
                    $streets_value = DB::table('gatves')->find($v->streets);
                    $streets[$v->id] = !empty($streets_value) ? $streets_value->gatve_name : '';
                }
                if($v->userID > 0){
                    $userID_value = DB::table('users')->find($v->userID);
                    $userID[$v->id] = !empty($userID_value) ? $userID_value->first_name . ' ' . $userID_value->last_name  : '';
                }
                 if(isset($v->notes_lt)){
                    $v->notes_lt = $this->modifyDescription($v->notes_lt);
                }elseif(isset($v->notes_ru)){
                    $v->notes_ru = $this->modifyDescription($v->notes_ru);
                }

                  if($v->purpose != ''){
                    $purpose_value = explode(';', $v->purpose);
                    foreach($purpose_value as $key => $val){
                        $purpose_value[$key] = __('string.' . $val);
                     }
                    $v->purpose = implode(', ', $purpose_value);
                }

            }

            if(isset($request->type ) && $request->type == 'simple'){
                $request->session()->put('type', 'simple');
            }
            elseif(isset($request->type ) && $request->type == 'tile'){
                $request->session()->put('type', 'tile');
            }


            $scroll = true;
            $active_main_menu_link = 'homepage';


             return view('frontend.welcome',
                compact('data', 'photo', 'region', 'itemtype',
                'quarter', 'city', 'streets', 'userID', 'scroll', 'active_main_menu_link')
            );


    }


      public function getRegion(){
        $res = DB::select('select id, miestas_name from miestas where parent_id = ? ORDER BY miestas_name', [(int)$_GET['region']]);

        if($res) {
            $arr = '<option value="">'.__('string.Pasirinkite').'</option>';
            $selected = '';
            foreach($res as $v){
                $arr .= '<option value="'.$v->id.'" '.$selected.'>'.$v->miestas_name.'</option>';
                $selected = '';
            }
            echo $arr;
        }
    }


        public function getMikroregion(){
            $res = DB::select('select id, kvartalas_name from kvartalas where parent_id = ? ORDER BY kvartalas_name', [(int)$_GET['miestas']]);

            if($res) {
                $arr = '<div class="search-box5"><input type="text" id="searchInput5" placeholder="' . __('search.Ieškoti') . ' ..."></div>';
                foreach($res as $v){
                    $arr .= ' <div class="option"><label><input type="checkbox" value="'.$v->id.'">'.$v->kvartalas_name.'</label></div>';
                }
                echo $arr;
            }
        }

    public function getGatve(){
        $res = DB::select('select id, gatve_name from gatves where parent_id = ? ORDER BY gatve_name', [(int)$_GET['miestas']]);

        if($res) {
            $arr = '<div class="search-box6"><input type="text" id="searchInput6" placeholder="' . __('search.Ieškoti') . ' ..."></div>';
            foreach($res as $v){
                $arr .= ' <div class="option"><label><input type="checkbox" value="'.$v->id.'">'.$v->gatve_name.'</label></div>';
            }
            echo $arr;
        }
    }


    public function modifyDescription($note){

           if(strlen($note) > 260){
                    $temp = explode(' ',  substr($note, 0, 260) );
                    unset($temp[count($temp)-1]);

                    $note = implode(' ', $temp);

                    if( preg_match("/[0-9.!?,;:]$/",$note) )
                        $note = substr($note, 0,-1);
                    $note .= '...';
                }

        return $note;
    }


    public function sendmail(Request $request){
        if(!empty($request->page))
            $data['page'] = $request->page;
        if(!empty($request->phone))
            $data['phone'] = $request->phone;
        if(!empty($request->email))
            $data['email'] = $request->email;
        if(!empty($request->message))
            $data['message'] = $request->message;
        if(!empty($request->page))
            $data['name'] = $request->name;
        if(!empty($request->surname))
            $data['surname'] = $request->surname;

        $recepient_id = null;
        if(!empty($request->item_id)){
            $data['item_id'] = $request->item_id ;
            $recepient_id = DB::select('SELECT t2.email FROM `cms_module_ntmodulis` t LEFT JOIN users t2 ON t2.id = t.userID WHERE t.id = ?', [$request->item_id]);
        }

        
        $recepient = $recepient_id ? $recepient_id[0]->email : 'info@alginosnt.lt';
        // dd($recepient);

try {
    Mail::to($recepient)->send(new SendMail($data));
    return response()->json(['status'=> 200, 'message' => __('string.Išsiusta sėkmingai').'!!!']);
} catch (\Exception $e) {
    return response()->json(['status'=> 1000, 'message' => __('string.Bandykite dar karta') . '!!!']);
}


    }





}
