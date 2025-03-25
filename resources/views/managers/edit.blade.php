@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'NT Modulis')
@section('content_header_subtitle', 'Objekto redagavimas')
{{-- Content body: main page content --}}
@section('content_body')

@include('MyComponents.error')

<div class="card-body">
    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Naujas vadybininkas</a>
        </li>
      </ul>
      <div class="tab-content" id="custom-content-below-tabContent">
        <div class="tab-pane fade active show" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
          <div class="butas tipas">
              <form method="post" enctype="multipart/form-data" action="" x-data x-validate @submit="$validate.submit">
                  @csrf
                  <input name="itemType" hidden="hidden" value="butas"/>
                  <ul>
                      <li><label>Username</label>
                        <input type="text" name="username" value="{{$data->username}}" required data-error-msg="Užpildykite laukelį" />
                      </li>
                      <li><label>Username</label>
                        <input type="text" name="username" value="{{$data->username}}" />
                      </li>
                      <li><label>Username</label>
                        <input type="text" name="username" value="{{$data->username}}" />
                      </li>
                      <li><label>Username</label>
                        <input type="text" name="username" value="{{$data->username}}" />
                      </li>
                      <li><label>Username</label>
                        <input type="text" name="username" value="{{$data->username}}" />
                      </li>
                      <hr/>
                      <li>@include('MyComponents.submit')</li>
                  </ul></form>
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
            width: 80%;
        }
    .block ul {
        display: flex;
        flex-wrap: wrap;
    }
    .block ul li{
        margin-bottom: 1%;
        white-space: nowrap;
    }
    
    .block ul li:not(.nav-item) {
        width: 20%;
    }

    li label {
        white-space: nowrap
    }

    .block ul li label{
        cursor: pointer;
        vertical-align: middle;
    }
    .block ul li input[type=checkbox] {
        margin-right: 5px;
    }

   div[id^='custom-content-below-']{
        margin: 30px 0;
    }

    label {
        width: 200px;
    }

    select, input[type="text"]{
        min-width: 200px
    }

    textarea {
        padding: 2px 5px; 
    }



</style>
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script>

        $(function(){
            $('#photo_container').sortable({
                update: function( event, ui ) {
                    updateImages()
                }
            })
        })

        function updateImages(){
            let photos = []
                    $('#photo_container li img').each(function(){
                        photos.push($(this).data('path'))
                    })

                    const id = {{ $data->id }};

                    $.ajax({
                        url:`/admin/updateOrder`,
                        type:"POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{ photos, id },
                        success: function(data){
                            console.log(data);
                        }
                    })
        }


        $('.delete_image').click(function(){
            if(confirm('Ar tikrai trinti?')){
                $(this).closest('li').remove()
                updateImages()
            }
        })


        $('select[name="region"]').change(function(){
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
                        }
                    })

                }
            })
        })




    </script>
@endpush
