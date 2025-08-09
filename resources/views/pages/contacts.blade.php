@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', '')
@section('content_header_title', 'Kontaktai')
@section('content_header_subtitle', '')

{{-- Content body: main page content --}}

@section('content_body')
@include('MyComponents.alert')

    <form method="POST" action="{{route('admin.pages.contacts')}}" enctype="multipart/form-data" id="service_form">
        @csrf
         <p>
        <b>Puslapio antraštė:</b>
        <input name="title" placeholder="Puslapio pavadinimas" value="{{$data->title}}" type="text" />
        <input name="title_ru" placeholder="Puslapio pavadinimas RU" value="{{$data->title_ru}}" type="text" />
    </p>
    <br>
        <p>
            <b>Įmonės kodas:</b>
            <input type="text" name="ik" placeholder="" value="{{$data->ik}}" />
        </p>
        <p>
            <b>PVM mokėtojo kodas:</b>
            <input type="text" name="mk" placeholder="" value="{{$data->mk}}" />
        </p>
        <p>
            <b>Telefonas:</b>
            <input type="text" name="phone" placeholder="" value="{{$data->phone}}" />
        </p>
        <p>
            <b>El. paštas:</b>
            <input type="text" name="email" placeholder="" value="{{$data->email}}" />
        </p>
        <p>
            <b>Adresas:</b>
            <input type="text" name="address" placeholder="" value="{{$data->address}}" />
        </p>
        <p>
            <b>Žemėlapis:</b>
            <textarea name="map">{{$data->map}}</textarea>
        </p>



        <input type="submit" label="Save" class="btn  btn-secondary" value="Išsaugoti" />
    </form>

@stop



{{-- Push extra CSS --}}

@push('css')
    <style>


        #service_form {
            padding: 20px;
        }


        #service_form input[type="text"]{
            margin-left: 10px;
            width: 400px;
            padding: 5px;
        }

        #service_form textarea {
            width: 70%;
            height: 150px;
            margin-left: 10px;
            padding: 5px 10px;
        }

         #service_form input[type="submit"]{
            margin-top: 20px;
        }


    </style>

@endpush



@push('js')

@endpush
