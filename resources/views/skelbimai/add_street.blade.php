@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'NT Modulis')
@section('content_header_subtitle', 'Naujas objektas')

{{-- Content body: main page content --}}

@section('content_body')
@include('MyComponents.alert')
<div class="card-body">
            <h4>Pasirinkite objekto tipa</h4>
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab"  aria-selected="true"><img src="{{asset('storage/svg/apartment.svg') }}">Butas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false"><img src="{{asset('storage/svg/house.svg') }}">Namas, kotedžas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-sodyba-tab" data-toggle="pill" href="#custom-content-below-sodyba" role="tab" aria-controls="custom-content-below-sodyba" aria-selected="false"><img src="{{asset('storage/svg/treehouse.jpg') }}">Sodyba</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-sodas-tab" data-toggle="pill" href="#custom-content-below-sodas" role="tab" aria-controls="custom-content-below-sodas" aria-selected="false"><img src="{{asset('storage/svg/tree.png') }}">Sodas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-sklypas-tab" data-toggle="pill" href="#custom-content-below-sklypas" role="tab" aria-controls="custom-content-below-sklypas" aria-selected="false"><img src="{{asset('storage/svg/lot.svg') }}">Sklypas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-patalpa-tab" data-toggle="pill" href="#custom-content-below-patalpa" role="tab" aria-controls="custom-content-below-patalpa" aria-selected="false"><img src="{{asset('storage/svg/premise.svg') }}">Patalpos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-garazas-tab" data-toggle="pill" href="#custom-content-below-garazas" role="tab" aria-controls="custom-content-below-garazas" aria-selected="false"><img src="{{asset('storage/svg/garage.svg') }}">Garažas</a>
              </li>
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade active show" id="custom-content-below-home" role="tabpanel" >
                <div class="butas tipas">
                    <form method="post" enctype="multipart/form-data" action="">
                        @csrf
                        <input name="itemType" hidden="hidden" value="butas"/>
                        <ul>
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
                            <li><label>Gatvė</label>
                                <input type="text" name="gatve">
                            </li>
                            
                            <hr/>
                            <li>@include('MyComponents.submit')</li>
                        </ul></form>
                </div>
              </div>

              </div>
            </div>
          </div>





@stop

{{-- Push extra CSS --}}

@push('css')
<style>

.card-body .nav-item {
    display: flex;
}
.card-body .nav-link {
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    align-items: center;
}

.alert-dismissible {
    width: fit-content;
}

label.show {
    margin-left: 10px;
}

.block {
            display: inline-block;
            width: 90%;
        }
.block ul {
        display: flex;
        flex-wrap: wrap;
    }
    .block ul li {
        width: 20%;
        margin-bottom: 1%;
        white-space: nowrap;
    }

    li label {
        white-space: nowrap
    }

    .block ul li label{
        cursor: pointer;
    }
    .block ul li input[type=checkbox] {
        margin-right: 5px;
    }

    .tab-pane{
        margin: 30px 0;
    }

    label {
        width: 150px;
    }

    select, input[type="text"]{
        min-width: 200px
    }



</style>
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script>

        $('select[name="region"]').change(function(){

            $('select[name="quarter"]').attr('disabled', false)
            $('select[name="streets"]').attr('disabled', false)
            $('select[name="quarter"] option:first-child').attr('selected', true)
            $('select[name="streets"] option:first-child').attr('selected', true)

            const id = $(this).val()
            $.get(`/admin/getRegion?region=${id}`,{},function(data){
                if(data){
                   $('select[name="city"]').html(data)
                }
            })
        })

        $('select[name="city"]').change(function(){
            const id = $(this).val()
            $.get(`/admin/getMikroregion?miestas=${id}`,{},function(data){
                if(data){
                   $('select[name="quarter"]').html(data)

                   $.get(`/admin/getGatve?miestas=${id}`,{},function(data){

                        if(data){
                            $('select[name="streets"]').html(data)
                        } else {
                            $('select[name="streets"]').attr('disabled', true)
                            $('select[name="streets"] option:first-child').attr('selected', true)
                        }
                    })

                }else {
                    $('select[name="quarter"]').attr('disabled', true)
                    $('select[name="streets"]').attr('disabled', true)
                    $('select[name="quarter"] option:first-child').attr('selected', true)
                    $('select[name="streets"] option:first-child').attr('selected', true)
                }
            })
        })




    </script>
@endpush
